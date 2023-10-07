<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Order';
        if ($request->ajax()) {
            $order = Order::leftJoin('customer', 'customer.id', '=', 'order.customer_id')
                ->leftJoin('user', 'user.id', '=', 'order.user_id')
                ->select('order.*', 'customer.name as customer', 'user.name as user')
                ->where(function ($query) use ($request) {
                    if (getUser()->role != 1) {
                        $query->where('order.user_id', getUser()->id);
                    }
                });

            return DataTables::of($order)
                ->toJson();
        }
        return view('admin.order.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Order';
        $data['category'] = Category::all();
        $data['customer'] = Customer::all();
        return view('admin.order.create', $data);
    }

    public function store(Request $request)
    {
        $total = 0;
        $stock = [];
        $detail = [];

        DB::beginTransaction();
        try {
            foreach ($request->cart as $item) {
                $total += $item['price'] * $item['qty'];
                $stock = Stock::create([
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'purchase_price' => $item['purchase_price'],
                    'selling_price' => $item['price'],
                    'description' => 'Order',
                    'status' => config('constants.stock.out'),
                    'updated_at' => now(),
                ]);

                $detail[] = new OrderDetail([
                    'discount' => 0,
                    'stock_id' => $stock->id,
                ]);
            }

            $discount = $request->discount / 100 * $total;
            $total = $total - $discount;
            $paid = str_replace(',', '', $request->paid);
            $order = Order::create([
                'invoice_code' => 'INV-' . date('YmdHis'),
                'customer_id' => $request->customer,
                'amount' => $total,
                'paid' => $paid,
                'change' => $paid - $total,
                'discount' => $discount,
                'status' => 1,
                'user_id' => auth()->user()->id,
                'updated_at' => now(),
            ]);

            $order->detail()->saveMany($detail);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Order created successfully',
                'redirect' => route('admin.order.index') . '/' . $order->id . '/print'
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function show($id)
    {
        $order = Order::with([
            'detail.stock.product',
            'customer',
            'user'
        ])->where('id', $id)->first();

        return response()->json([
            'status' => 'success',
            'data' => $order
        ]);
    }

    public function update(Request $request, $id)
    {
        $findOrder = Order::with('detail.stock')->where('id', $id)->first();

        DB::beginTransaction();

        try {
            // update status order
            $findOrder->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            // create stock return
            foreach ($findOrder->detail as $item) {
                Stock::create([
                    'product_id' => $item->stock->product_id,
                    'qty' => $item->stock->qty,
                    'purchase_price' => $item->stock->purchase_price,
                    'selling_price' => $item->stock->selling_price,
                    'description' => 'Return',
                    'status' => config('constants.stock.in'),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Order canceled successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function print($id)
    {
        $data['order'] = Order::with([
            'detail.stock.product',
            'customer',
            'user'
        ])->where('id', $id)->first();

        // if ($data['order']->status == 0) {
        //     abort(403, 'Order canceled');
        // }
        return view('admin.order.print', $data);
    }
}

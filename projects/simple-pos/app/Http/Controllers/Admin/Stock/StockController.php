<?php

namespace App\Http\Controllers\Admin\Stock;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $stock = Stock::where('product_id', $request->product)
                ->where('status', $request->status);

            return DataTables::of($stock)
                ->make(true);
        }

        abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required',
            'qty' => 'required',
            'purchase_price' => 'required',
        ]);

        // remove dot from qty & purchase_price
        $qty = str_replace('.', '', $request->qty);
        $purchase_price = str_replace('.', '', $request->purchase_price);

        // remove Rp from purchase_price
        $purchase_price = str_replace('Rp ', '', $purchase_price);

        $store = Stock::updateOrCreate([
            'id' => $request->id
        ], [
            'product_id' => $request->product,
            'qty' => $qty,
            'purchase_price' => $purchase_price,
            'status' => config('constants.stock.in'),
            'description' => 'Stock In',
            'updated_at' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Stock added successfully',
            'data' => $store
        ]);
    }
}

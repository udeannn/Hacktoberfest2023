<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customer = Customer::query();
            return DataTables::of($customer)
                ->make(true);
        }

        $data['title'] = 'Customer';
        return view('admin.customer.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required|unique:customer,phone_number,' . $request->id,
        ]);

        $store = Customer::updateOrCreate([
            'id' => $request->id
        ], [
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'updated_at' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $request->id == null ? 'Customer created successfully' : 'Customer updated successfully',
            'data' => $store
        ]);
    }

    public function edit($id)
    {
        $findCustomer = Customer::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $findCustomer
        ]);
    }

    public function destroy($id)
    {
        $findCustomer = Customer::find($id);

        if ($findCustomer) {
            $findCustomer->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Customer deleted successfully',
            ]);
        }
    }
}

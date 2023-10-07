<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function product(Request $request)
    {
        $product = Product::when($request->category, function ($query) use ($request) {
            $query->where('category_id', $request->category);
        })
            ->where(function ($query) use ($request) {
                if ($request->q) {
                    $query->where('product.name', 'like', '%' . $request->q . '%')
                        ->orWhere('product.sku', 'like', '%' . $request->q . '%');
                }
            })
            ->select('product.*')
            ->category()
            ->stock()
            ->avaragePurchasePrice()
            ->groupBy('product.id')
            ->limit(20)
            ->get();

        if ($request->have_stock) {
            $product = $product->filter(function ($item) {
                // stok > 0 && selling_price > 0
                return $item->stock > 0 && $item->selling_price > 0;
            });
        }

        return response()->json($product);
    }
}

<?php

namespace App\Models;

use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, Scopes;

    protected $table = 'product';

    protected $guarded = ['id'];

    public function scopeCategory($query)
    {
        return $query->leftJoin('category', 'category.id', '=', 'product.category_id')
            ->addSelect([
                'category.name as category'
            ]);
    }

    public function scopeStock($query)
    {
        return $query->leftJoin('stock', 'stock.product_id', '=', 'product.id')
            ->addSelect([
                DB::raw('SUM(IF(stock.status = 1, stock.qty,0)-IF(stock.status = 0, stock.qty,0)) as stock')
            ]);
    }

    public function scopeAvaragePurchasePrice($query)
    {
        return $query->addSelect([
            DB::raw('ROUND(SUM(IF(stock.status = 1 AND description != "Return", stock.purchase_price * stock.qty,0)) / SUM(IF(stock.status = 1 AND description != "Return", stock.qty,0))-SUM(IF(stock.status = 0, stock.purchase_price * stock.qty,0)) / SUM(IF(stock.status = 1, stock.qty,0))) as avarage_purchase_price')
        ]);
    }
}

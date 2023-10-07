<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id');
    }
}

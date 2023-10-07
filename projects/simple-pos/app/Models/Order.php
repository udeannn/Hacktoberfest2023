<?php

namespace App\Models;

use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Scopes;

    protected $table = 'order';

    protected $guarded = ['id'];

    function detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

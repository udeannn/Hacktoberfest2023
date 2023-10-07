<?php

namespace App\Models;

use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Scopes;

    protected $table = 'customer';

    protected $guarded = ['id'];

    public $timestamps = true;
}

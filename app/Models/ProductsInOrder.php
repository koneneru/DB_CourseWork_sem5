<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsInOrder extends Model
{
    use HasFactory;

    protected $table = 'products_in_orders';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'order', 'product', 'count',
    ];
}

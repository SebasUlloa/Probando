<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Sensors_Products extends Model
{
    use HasFactory;

    protected $table = 'product__sensors__products';

    protected $primaryKey = 'productSensorProductsId';
}

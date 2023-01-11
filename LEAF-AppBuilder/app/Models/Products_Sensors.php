<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_Sensors extends Model
{
    use HasFactory;

    protected $table = 'products__sensors';

    protected $primaryKey = 'productSensorsId';
}

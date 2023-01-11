<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sensors_inputtype extends Model
{
    use HasFactory;

    protected $table = 'sensors_inputtype';

    protected $primaryKey = 'sensors_inputtypeId';
}

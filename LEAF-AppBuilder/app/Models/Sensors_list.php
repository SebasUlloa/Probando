<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensors_list extends Model
{
    use HasFactory;

    protected $table = 'sensors_list';

    protected $primaryKey = 'sensorslist_Id';
}

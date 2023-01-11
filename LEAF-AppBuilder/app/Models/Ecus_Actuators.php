<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecus_Actuators extends Model
{
    use HasFactory;

    
    protected $table = 'ecus_actuators';

    protected $primaryKey = 'ecusActuatorsId';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actuators_Sensors extends Model
{
    use HasFactory;

    protected $table = 'actuators_sensors';

    protected $primaryKey = 'actuatorsSensorsId';
}

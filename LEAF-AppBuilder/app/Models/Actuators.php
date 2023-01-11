<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actuators extends Model
{
    use HasFactory;

    protected $table = 'actuators';

    protected $primaryKey = 'actuatorsId';
}

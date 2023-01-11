<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actuator_Subtype extends Model
{
    use HasFactory;

    protected $table = 'actuator_subtype';

    protected $primaryKey = 'actuator_subtypeId';
}

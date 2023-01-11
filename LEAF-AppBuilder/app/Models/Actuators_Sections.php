<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actuators_Sections extends Model
{
    use HasFactory;

    protected $table = 'actuator_sections';

    protected $primaryKey = 'actuatorsectionsid';
}

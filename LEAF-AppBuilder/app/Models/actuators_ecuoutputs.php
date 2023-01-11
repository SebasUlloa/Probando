<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actuators_ecuoutputs extends Model
{
    use HasFactory;

    protected $table = 'actuators_ecuoutputs';

    protected $primaryKey = 'actuators_ecuoutputsId';
}

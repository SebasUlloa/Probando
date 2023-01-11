<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actuators_Rows extends Model
{
    use HasFactory;

    protected $table = 'actuators_rows';

    protected $primaryKey = 'actuatorsrowsId';
}

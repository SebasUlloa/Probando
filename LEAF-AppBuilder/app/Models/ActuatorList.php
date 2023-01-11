<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActuatorList extends Model
{
    use HasFactory;

    protected $table = 'actuator_list';

    protected $primaryKey = 'actuator_listId';
}

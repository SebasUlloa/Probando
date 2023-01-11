<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecu_list extends Model
{
    use HasFactory;

    protected $table = 'ecu_list';

    protected $primaryKey = 'ecu_listId';
}

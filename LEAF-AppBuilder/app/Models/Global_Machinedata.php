<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Global_Machinedata extends Model
{
    use HasFactory;

    protected $table = 'global_machinedata';

    protected $primaryKey = 'globalId';
}

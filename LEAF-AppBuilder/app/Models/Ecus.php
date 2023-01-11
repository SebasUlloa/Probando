<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecus extends Model
{
    use HasFactory;

    protected $table = 'ecus';

    protected $primaryKey = 'ecuId';
}

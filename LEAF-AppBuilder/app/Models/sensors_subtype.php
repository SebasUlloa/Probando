<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sensors_subtype extends Model
{
    use HasFactory;

    protected $table = 'sensors_subtype';

    protected $primaryKey = 'sensors_subtypeid';
}

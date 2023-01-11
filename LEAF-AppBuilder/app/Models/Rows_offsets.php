<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rows_offsets extends Model
{
    use HasFactory;

    protected $table = 'rows_offset';

    protected $primaryKey = 'rowoffsetId';
}

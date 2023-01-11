<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section_Rows extends Model
{
    use HasFactory;

    protected $table = 'sections_rows';

    protected $primaryKey = 'sectionrowsid';
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\MachineData;
use PDO, PDOException;

class Plantingtypes extends Model
{
    use HasFactory;

    protected $primaryKey = 'plantingtypeId';

    

}

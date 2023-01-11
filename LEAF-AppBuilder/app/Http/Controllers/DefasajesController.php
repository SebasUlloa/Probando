<?php

namespace App\Http\Controllers;

use App\Models\ActuatorList;
use App\Models\Actuator_Subtype;
use App\Models\Rows_offsets;
use Illuminate\Http\Request;
use App\Models\MachineData;
use Illuminate\Support\Facades\DB;

class DefasajesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
   
    public function index()
    {
    $crucianelli = MachineData::all();
    return view('defasajes.defasajes');
    
    }

    public function createoffset(Request $request)
    {  
        $machineId       = $this->lastId();
        $lastoffsetid    = $this->lastOffsetId();

        $actuators = ActuatorList::all();
        $turbines  = Actuator_Subtype::where('actuator_listId', 4)->get();
        $electrovalves = Actuator_Subtype::where('actuator_listId', 5)->get();

        $rowsdescription   =    $request->input('rowsdescription');
        $range             =    $request->input('range');
    
        if($rowsdescription){
            //`` -  `rowoffsetId` `machineId``row_description``offset`
            DB::table('rows_offset')->insert([
                'rowoffsetId' => $lastoffsetid,
                'machineId' => $machineId,
                'row_description' => $rowsdescription, 
                'offset' => $range
                ]);

                $lastoffsetid++;
        }

        return view('actuadores.actuators', compact('actuators', 'turbines', 'electrovalves'));
    }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show(Rows_offsets $defasajes)
    {
        //
    }

    
    public function edit(Rows_offsets $defasajes)
    {
        //
    }

  
    public function update(Request $request, Rows_offsets $defasajes)
    {
        //
    }

    
    public function destroy(Rows_offsets $defasajes)
    {
        //
    }

    public function lastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        
        $lastId = 0 + $machine->machineId;
        
        return $lastId;
    }

    public function lastOffsetId()
    {
        $lastoffset = Rows_offsets::select('rowoffsetId')->orderByDesc('rowoffsetId')->first();
        
        if($lastoffset){
            $lastoffset = 1 + $lastoffset->rowoffsetId;
        }else{
            $lastoffset = 1;
        }
     
        return $lastoffset;
    }
}

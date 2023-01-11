<?php

namespace App\Http\Controllers;

use App\Models\Actuators;
use App\Models\Ecus;
use App\Models\sensors_subtype;
use App\Models\Sensors_list;
use App\Models\Ecu_list;
use Illuminate\Http\Request;
use App\Models\MachineData;
use Illuminate\Support\Facades\DB;

class EcusController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Aca al agregar use app models crucianelli...podemos usar para traer todos los registros
        $ecu = Ecu_list::all();
        return view('ecus.ecus')->with('ecu', $ecu); // aca a la vista le pedimos que nos traiga en la vista todos los registro de la variable crucianelli
    }

    
    public function createecus(Request $request)
    {
        $machineId = $this->lastid();
        $lastecuid = $this->lastEcuId();

        $actuators = Actuators::where('machineId', $machineId)->get();
        $sensors = Sensors_list::all();
        $subtypespresion = sensors_subtype::all()->where('sensorslist_Id', 4);
        $subtypevelo = sensors_subtype::all()->where('sensorslist_Id', 5);
        $ecus = Ecus::where('machineId', $machineId)->get();
      
        $queryrueda = sensors_subtype::where('sensors_subtypeid', 4)->first();
        $rueda = $queryrueda->name;

        $ecujoin = Ecus::all()->where('machineId',$machineId);
/*
        $sensorjoin = DB::table('sensors')
        ->select('sensorId','name')
        ->join('sensors_list','sensors_list.sensorslist_Id', '=', 'sensors.sensorslist_Id')
        ->where('sensors.machineId',$machineId)
        ->get();*/

        $dosh               =    $request->input('1');
        $cantdosh           =    $request->input('CANT-2H5');

        $queryaddress2h     =    DB::table('ecu_list')->select('address')->where('ecu_listId', 1)->first();
        $adress2h           =    $queryaddress2h->address;
        $queryname2h        =    DB::table('ecu_list')->select('name')->where('ecu_listId', 1)->first();
        $name2h             =    $queryname2h->name;

        $tresh              =    $request->input('2');
        $canttresh          =    $request->input('CANT-3H');
        $queryaddress3h     =    DB::table('ecu_list')->select('address')->where('ecu_listId', 2)->first();
        $adress3h           =    $queryaddress3h->address;
        $queryname3h        =    DB::table('ecu_list')->select('name')->where('ecu_listId', 2)->first();
        $name3h             =    $queryname3h->name;

        $cuatroh            =    $request->input('3');
        $cantcuatroh        =    $request->input('CANT-4H8');
        $queryaddress4h     =    DB::table('ecu_list')->select('address')->where('ecu_listId', 3)->first();
        $adress4h           =    $queryaddress4h->address;
        $queryname4h        =    DB::table('ecu_list')->select('name')->where('ecu_listId', 3)->first();
        $name4h             =    $queryname4h->name;

        $veintucuatros      =    $request->input('4');
        $cantveintucuatros  =    $request->input('CANT-24S');
        $queryaddress24s     =    DB::table('ecu_list')->select('address')->where('ecu_listId', 4)->first();
        $adress24s           =    $queryaddress24s->address;
        $queryname24s        =    DB::table('ecu_list')->select('name')->where('ecu_listId', 4)->first();
        $name24s             =    $queryname24s->name;

        $concentrador       =    $request->input('5');
        $cantconcentrador   =    $request->input('CANT-Concentrador');
        $queryaddresscon    =    DB::table('ecu_list')->select('address')->where('ecu_listId', 5)->first();
        $adressconcen       =    $queryaddresscon->address;
        $querynamecon       =    DB::table('ecu_list')->select('name')->where('ecu_listId', 5)->first();
        $nameconcen         =   $querynamecon->name;
        // ecus - `ecuId ` `machineId` `ecu_listId` `name` `adress` 
        if($dosh){
            if($cantdosh > 1){
                for($i=1; $i <= $cantdosh; $i ++){

                    DB::table('ecus')->insert([
                        'ecuId' => $lastecuid,
                        'machineId' => $machineId,
                        'ecu_listId' => 1, 
                        'name' => 'ECU'.$i.'-'.$name2h,
                        'adress' => $adress2h
                        ]);
        
                        $lastecuid++;
                        $adress2h++;
                }
            }else{

                DB::table('ecus')->insert([
                    'ecuId' => $lastecuid,
                    'machineId' => $machineId,
                    'ecu_listId' => 1, 
                    'name' => 'ECU1-'.$name2h,
                    'adress' => $adress2h
                    ]);
    
                    $lastecuid++;
            }
        }
        if($tresh){
            if($canttresh > 1){
                for($i=1; $i <= $canttresh; $i ++){

                    DB::table('ecus')->insert([
                        'ecuId' => $lastecuid,
                        'machineId' => $machineId,
                        'ecu_listId' => 2, 
                        'name' => 'ECU'.$i.'-'.$name3h,
                        'adress' => $adress3h
                        ]);
        
                        $lastecuid++;
                        $adress3h++;
                }
            }else{

                DB::table('ecus')->insert([
                    'ecuId' => $lastecuid,
                    'machineId' => $machineId,
                    'ecu_listId' => 2, 
                    'name' => 'ECU1-'.$name3h,
                    'adress' => $adress3h
                    ]);
    
                    $lastecuid++;
            }
        }
        if($cuatroh){////aca
            if($cantcuatroh > 1){
                for($i=1; $i <= $cantcuatroh; $i ++){

                    DB::table('ecus')->insert([
                        'ecuId' => $lastecuid,
                        'machineId' => $machineId,
                        'ecu_listId' => 3, 
                        'name' => 'ECU'.$i.'-'.$name4h,
                        'adress' => $adress4h
                        ]);
        
                        $lastecuid++;
                        $adress4h++;
                }
            }else{

                DB::table('ecus')->insert([
                    'ecuId' => $lastecuid,
                    'machineId' => $machineId,
                    'ecu_listId' => 3, 
                    'name' => 'ECU1-'.$name4h,
                    'adress' => $adress4h
                    ]);
    
                    $lastecuid++;
            }
        }
        if($veintucuatros){
            if($cantveintucuatros > 1){
                for($i=1; $i <= $cantveintucuatros; $i ++){

                    DB::table('ecus')->insert([
                        'ecuId' => $lastecuid,
                        'machineId' => $machineId,
                        'ecu_listId' => 4, 
                        'name' => 'ECU'.$i.'-'.$name24s,
                        'adress' => $adress24s
                        ]);
        
                        $lastecuid++;
                        $adress24s++;
                }
            }else{

                DB::table('ecus')->insert([
                    'ecuId' => $lastecuid,
                    'machineId' => $machineId,
                    'ecu_listId' => 4, 
                    'name' => 'ECU1-'.$name24s,
                    'adress' => $adress24s
                    ]);
    
                    $lastecuid++;
            }
        }
        if($concentrador){
            if($cantconcentrador > 1){
                for($i=1; $i <= $cantconcentrador; $i ++){

                    DB::table('ecus')->insert([
                        'ecuId' => $lastecuid,
                        'machineId' => $machineId,
                        'ecu_listId' => 5, 
                        'name' => 'ECU'.$i.'-'.$nameconcen,
                        'adress' => $adressconcen
                        ]);
        
                        $lastecuid++;
                        $adressconcen++;
                }
            }else{

                DB::table('ecus')->insert([
                    'ecuId' => $lastecuid,
                    'machineId' => $machineId,
                    'ecu_listId' => 5, 
                    'name' => 'ECU1-'.$nameconcen,
                    'adress' => $adressconcen
                    ]);
    
                    $lastecuid++;
            }
        }

        return view('sensors.sensors', compact('ecus','sensors')); 
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show(Ecus $ecus)
    {
        //
    }

   
    public function edit(Ecus $ecus)
    {
        //
    }

  
    public function update(Request $request, Ecus $ecus)
    {
        //
    }

   
    public function destroy(Ecus $ecus)
    {
        //
    }

    public function lastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        
        $lastId = 0 + $machine->machineId;
        
        return $lastId;
    }

    public function lastEcuId()
    {
        $lastecuID = Ecus::select('ecuId')->orderByDesc('ecuId')->first();
        
        if($lastecuID){
            $lastecuID = 1 + $lastecuID->ecuId;
        }else{
            $lastecuID = 1;
        }
     
        return $lastecuID;
    }
}

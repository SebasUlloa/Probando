<?php

namespace App\Http\Controllers;

use App\Models\Sensors;
use App\Models\Sensors_list;
use App\Models\sensors_subtype;
use App\Models\sensors_inputtype;
use App\Models\Actuators;
use App\Models\Actuator_Subtype;
use App\Models\Ecus;
use App\Models\Actuators_Sensors;
use App\Models\Plantingtypes;
use Illuminate\Http\Request;
use App\Models\MachineData;
use Illuminate\Support\Facades\DB;

class SensorsController extends Controller
{
    //Esto es de Seguridad para que no entren con el / /
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
        $machineId = $this->lastId();    
        $sensors = Sensors_list::all();
        $subtypespresion = sensors_subtype::all()->where('sensorslist_Id', 4);
        $subtypevelo = sensors_subtype::all()->where('sensorslist_Id', 5);
        $actuators = Actuators::all()->where('machineId', $machineId);
        $queryrueda = sensors_subtype::where('sensors_subtypeid', 4)->get();
        $rueda = $queryrueda->name;

        $ecu = Ecus::all()->where('machineId',$machineId);

        return view('sensors.sensors')
        ->with('sensors', $sensors)
        ->with('actuators', $actuators)
        ->with('subtypespresion',$subtypespresion)
        ->with('rueda',$rueda)
        ->with('ecu',$ecu)
        ->with('subtypevelo',$subtypevelo);

        
    }

    public function indexmonitor()
    {
    $machineId = $this->lastId();    
    $sensors = Sensors_list::all();
    $subtypespresion = sensors_subtype::all()->where('sensorslist_Id', 4);
    $subtypevelo = sensors_subtype::all()->where('sensorslist_Id', 5);
    $actuators = Actuators::all()->where('machineId', $machineId);

    return view('sensors.solo-monitor.sensorsclass')
    ->with('sensors', $sensors)
    ->with('actuators', $actuators)
    ->with('subtypespresion',$subtypespresion)
    ->with('subtypevelo',$subtypevelo);
    }

    public function hasfullsensors(Request $request){

        $machineId = $this->lastid();
        $lastsensorid = $this->lastSensorsId();

        $tolva         =    $request->input('TOLVA');
        $canttolva     =    $request->input('CANT-TOLVA');
        
        $rotacion      =    $request->input('ROTACION');
        $cantrotacion  =    $request->input('CANT-ROTACION');

        $rpm           =    $request->input('RPM');
        $cantrpm       =    $request->input('CANT-RPM');

        $presion       =    $request->input('PRESION');
        $cantpresion   =    $request->input('CANT-PRESION');

        $levante       =    $request->input('LEVANTE');
        $cantlevante   =    $request->input('CANT-LEVANTE');

        $velocidad     =    $request->input('VELOCIDAD');
        $cantvelocidad =    $request->input('CANT-VELOCIDAD');
        //dd($lastsensorid);
        if($tolva){
            //`sensorid``name``subtype``machineId``sensorslist_Id``updated_at``created_at`
                for($i=1; $i <= $canttolva; $i++){
                DB::table('sensors')->insert([
                    'sensorid' => $lastsensorid,
                    'name'     => 'TOLVA-'.$i,
                    'subtype' => 0,
                    'machineId' => $machineId,
                    'sensorslist_Id' => 1, // este iria con el subtipo
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);
                    $lastsensorid++; 
                }  
        }
    
        if($rotacion){
            for($i=1; $i <= $cantrotacion; $i++){
                DB::table('sensors')->insert([
                    'sensorid' => $lastsensorid,
                    'name'     => 'ROTACION-'.$i,
                    'subtype' => 0,
                    'machineId' => $machineId,
                    'sensorslist_Id' => 2, // este iria con el subtipo
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);
                $lastsensorid++;
            }
        }
        
        if($rpm){
            for($i=1; $i <= $cantrpm; $i++){
                DB::table('sensors')->insert([
                    'sensorid' => $lastsensorid,
                    'name'     => 'RPM-'.$i,
                    'subtype' => 0,
                    'machineId' => $machineId,
                    'sensorslist_Id' => 3, // este iria con el subtipo
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);
                $lastsensorid++;
            }
        }

        if($presion){
            for($i=1; $i <= $cantpresion; $i++){
            DB::table('sensors')->insert([
                'sensorid' => $lastsensorid,
                'name'     => 'PRESION-'.$i,
                'subtype' => 0,
                'machineId' => $machineId,
                'sensorslist_Id' => 4, // este iria con el subtipo
                'updated_at' => now(),
                'created_at' => now()
                ]);

            $lastsensorid++;
            }
        }

        if($levante){
            for($i=1; $i <= $cantlevante; $i++){
            DB::table('sensors')->insert([
                'sensorid' => $lastsensorid,
                'name'     => 'LEVANTE-'.$i,
                'subtype' => 0,
                'machineId' => $machineId,
                'sensorslist_Id' => 6, // este iria con el subtipo
                'updated_at' => now(),
                'created_at' => now()
                ]);

            $lastsensorid++;
            }
        }
        if($velocidad){
            for($i=1; $i <= $cantvelocidad; $i++){
            DB::table('sensors')->insert([
                'sensorid' => $lastsensorid,
                'name'     => 'VELOCIDAD-'.$i,
                'subtype' => 0,
                'machineId' => $machineId,
                'sensorslist_Id' => 5, // este iria con el subtipo
                'updated_at' => now(),
                'created_at' => now()
                ]);
            
            $lastsensorid++;
            }
        }
        
        $actuators      = Actuators::where('machineId', $machineId)->orderBy('actuatorsId', 'asc')->get();
        $ecus           = Ecus::where('machineId', $machineId)->orderBy('ecuId', 'asc')->get();
        $ecuscount      = Ecus::where('machineId', $machineId)->count();
        $elctrovalvulas = Actuator_Subtype::where('actuator_listId', 5)->orderBy('actuator_subtypeId', 'asc')->get();
        $turbina        = Actuator_Subtype::where('actuator_listId', 4)->orderBy('actuator_subtypeId', 'asc')->get();
        $sensors        = Sensors::where('machineId', $machineId)->orderBy('sensorId', 'asc')->get();
        $subtypespresion= sensors_subtype::where('sensorslist_Id', 4)->orderBy('sensors_subtypeid', 'asc')->get();
        $subtypevelo    = sensors_subtype::where('sensorslist_Id', 5)->orderBy('sensors_subtypeid', 'asc')->get();
        $inputtype      = sensors_inputtype::all();

        return view('relacionecus.relacionecus', compact('actuators','ecus','ecuscount','elctrovalvulas','turbina','sensors','inputtype','subtypespresion','subtypevelo'));
    }

    public function hassensors(Request $request){

        $machineId = $this->lastid();
        $lastsensorid = $this->lastSensorsId();

        $tolva         =    $request->input('TOLVA');
        $canttolva     =    $request->input('CANT-TOLVA');
        
        $rotacion      =    $request->input('ROTACION');
        $cantrotacion  =    $request->input('CANT-ROTACION');

        $rpm           =    $request->input('RPM');
        $cantrpm       =    $request->input('CANT-RPM');

        $presion       =    $request->input('PRESION');
        $cantpresion   =    $request->input('CANT-PRESION');

        $levante       =    $request->input('LEVANTE');
        $cantlevante   =    $request->input('CANT-LEVANTE');

        $velocidad     =    $request->input('VELOCIDAD');
        $cantvelocidad =    $request->input('CANT-VELOCIDAD');
        //dd($lastsensorid);
        if($tolva){
            //`sensorid``name``subtype``machineId``sensorslist_Id``updated_at``created_at`
                for($i=1; $i <= $canttolva; $i++){
                DB::table('sensors')->insert([
                    'sensorid' => $lastsensorid,
                    'name'     => 'TOLVA-'.$i,
                    'subtype' => 0,
                    'machineId' => $machineId,
                    'sensorslist_Id' => 1, // este iria con el subtipo
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);
                    $lastsensorid++; 
                }  
        }
    
        if($rotacion){
            for($i=1; $i <= $cantrotacion; $i++){
                DB::table('sensors')->insert([
                    'sensorid' => $lastsensorid,
                    'name'     => 'ROTACION-'.$i,
                    'subtype' => 0,
                    'machineId' => $machineId,
                    'sensorslist_Id' => 2, // este iria con el subtipo
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);
                $lastsensorid++;
            }
        }
        
        if($rpm){
            for($i=1; $i <= $cantrpm; $i++){
                DB::table('sensors')->insert([
                    'sensorid' => $lastsensorid,
                    'name'     => 'RPM-'.$i,
                    'subtype' => 0,
                    'machineId' => $machineId,
                    'sensorslist_Id' => 3, // este iria con el subtipo
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);
                $lastsensorid++;
            }
        }

        if($presion){
            for($i=1; $i <= $cantpresion; $i++){
            DB::table('sensors')->insert([
                'sensorid' => $lastsensorid,
                'name'     => 'PRESION-'.$i,
                'subtype' => 0,
                'machineId' => $machineId,
                'sensorslist_Id' => 4, // este iria con el subtipo
                'updated_at' => now(),
                'created_at' => now()
                ]);

            $lastsensorid++;
            }
        }

        if($levante){
            for($i=1; $i <= $cantlevante; $i++){
            DB::table('sensors')->insert([
                'sensorid' => $lastsensorid,
                'name'     => 'LEVANTE-'.$i,
                'subtype' => 0,
                'machineId' => $machineId,
                'sensorslist_Id' => 5, // este iria con el subtipo
                'updated_at' => now(),
                'created_at' => now()
                ]);

            $lastsensorid++;
            }
        }
        if($velocidad){
            for($i=1; $i <= $cantvelocidad; $i++){
            DB::table('sensors')->insert([
                'sensorid' => $lastsensorid,
                'name'     => 'VELOCIDAD-'.$i,
                'subtype' => 0,
                'machineId' => $machineId,
                'sensorslist_Id' => 6, // este iria con el subtipo
                'updated_at' => now(),
                'created_at' => now()
                ]);
            
            $lastsensorid++;
            }
        }
        $plantingtypes = Plantingtypes::where('machineID', $machineId)->get();
        return view('plantingtypes.solo-monitor.plantingtypesmonitor', compact('plantingtypes'));

    }


    public function createmonitor()
    {
        return view('sensors.solo-monitor.sensorslineamonitor');
    }

    public function lastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        
        $lastId = 0 + $machine->machineId;
        
        return $lastId;
    }

    public function lastSensorsId()
    {
        $lastsensors = Sensors::select('sensorid')->orderByDesc('sensorid')->first();
        
        if($lastsensors){
            $lastsen = 1 + $lastsensors->sensorid;
        }else{
            $lastsen = 1;
        }
     
        return $lastsen;
    }

    public function lastActuatorsSensorsId()
    {
        $lastactuatorsensors = Actuators_Sensors::select('actuators_sensors')->orderByDesc('actuatorsSensorsId')->first();
        
        if($lastactuatorsensors){
            $lastactsen = 1 + $lastactuatorsensors->actuatorsSensorsId;
        }else{
            $lastactsen = 1;
        }
     
        return $lastactsen;
    }


}

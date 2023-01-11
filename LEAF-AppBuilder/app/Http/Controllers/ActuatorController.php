<?php

namespace App\Http\Controllers;

use App\Models\Actuators;
use App\Models\ActuatorList;
use App\Models\Actuator_Subtype;
use App\Models\Ecu_list;
use Illuminate\Http\Request;
use App\Models\MachineData;
use App\Models\Sensors_list;
use App\Models\sensors_subtype;
use Illuminate\Support\Facades\DB;

class ActuatorController extends Controller
{
    public function index(){
        return view('actuadores.solo-monitor.actuatorsmonitor');
    }
    public function indexFull(){
        $actuators = ActuatorList::all();
        $turbines  = Actuator_Subtype::where('actuator_listId', 4)->get();
        $electrovalves = Actuator_Subtype::where('actuator_listId', 5)->get();

        return view('actuadores.actuators')
        ->with('actuators', $actuators)
        ->with('turbines', $turbines)
        ->with('electrovalves', $electrovalves);
    }

    public function hasactuator(Request $request)
    {
        $machineID = $this->lastId();

        $embrague = $request->input('E');
        $embragueacople = $request->input('EA');
        $motor = $request->input('M');
        $cajaelectro = $request->input('CE');
        $turbina = $request->input('T');
        $electrovalvula = $request->input('EV');

       // $actuators = $this->lastActuatorsId();

        $lastactuatorid = $this->lastActuatorsId();
        
    //actuatorsId	machineId	actuatorModelId	name	actuatorType
       
        if($embrague){
            for($i=1;$i<=$embrague;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'E'.$i,
                'actuatorType' => 0,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($embragueacople){
            for($i=1;$i<=$embragueacople;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'EA'.$i,
                'actuatorType' => 5,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($motor){
            for($i=1;$i<=$motor;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'M'.$i,
                'actuatorType' => 1,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($cajaelectro){
            for($i=1;$i<=$cajaelectro;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'CE'.$i,
                'actuatorType' => 2,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($turbina){
            for($i=1;$i<=$turbina;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'T'.$i,
                'actuatorType' => 3,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($electrovalvula){
            for($i=1;$i<=$electrovalvula;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'EV'.$i,
                'actuatorType' => 4,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            } 
        }
        /*
        $plantingtypes = Plantingtypes::where('machineID', $machineID)->get();
        return view('plantingtypes.solo-monitor.plantingtypesmonitor', compact('plantingtypes'));
        */
        $sensors = Sensors_list::all();
        $subtypespresion = sensors_subtype::all()->where('sensorslist_Id', 4);
        $subtypevelo = sensors_subtype::all()->where('sensorslist_Id', 5);
        $actuators = Actuators::all()->where('machineId', $machineID);
    
        return view('sensors.solo-monitor.sensorsclass')
        ->with('sensors', $sensors)
        ->with('actuators', $actuators)
        ->with('subtypespresion',$subtypespresion)
        ->with('subtypevelo',$subtypevelo);
    }

    public function hasFullactuators(Request $request)
    {
        $machineID = $this->lastId();

        $embrague       = $request->input('E');
        $embragueacople = $request->input('EA');
        $motor          = $request->input('M');
        $cajaelectro    = $request->input('CE');
        $turbina        = $request->input('T');
        $electrovalvula = $request->input('EV');

        $selectturbina = $request->input('turbines-Subtype');
        $selectelectrovalve = $request->input('electrovalve-Subtype');

        
        $subturbina  = Actuator_Subtype::where('actuator_subtypeId', $selectturbina)->first();
        $subelectrovalvula = Actuator_Subtype::where('actuator_subtypeId', $selectelectrovalve)->first();
        //dd($subturbina);
        
        $lastactuatorid = $this->lastActuatorsId();
       
        if($embrague){
            for($i=1;$i<=$embrague;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'E'.$i,
                'actuatorType' => 0,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($embragueacople){
            for($i=1;$i<=$embragueacople;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'EA'.$i,
                'actuatorType' => 5,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($motor){
            for($i=1;$i<=$motor;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'M'.$i,
                'actuatorType' => 1,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($cajaelectro){
            for($i=1;$i<=$cajaelectro;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'CE'.$i,
                'actuatorType' => 2,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                $lastactuatorid++;
            }
        }
        if($turbina){
            for($i=1;$i<=$turbina;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'T'.$i,
                'actuatorType' => 3,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                if($selectturbina){
                    DB::table('Actuators')
                    ->where('machineID', $machineID)
                    ->update([
                        'subtype' => $subturbina->actuator_subtype
                    ]);
                }

                $lastactuatorid++;
            }
        }
        if($electrovalvula){
            for($i=1;$i<=$electrovalvula;$i++){
                DB::table('Actuators')->insert([
                'actuatorsId' => $lastactuatorid,
                'machineId' => $machineID,
                'actuatorModelId' => null,
                'name' => 'EV'.$i,
                'actuatorType' => 4,
                'subtype' => 0,
                'updated_at' => now(),
                'created_at' => now()
                ]);

                if($selectelectrovalve){
                    DB::table('Actuators')
                    ->where('actuatorsId', $lastactuatorid)
                    ->update([
                        'subtype' => $subelectrovalvula->actuator_subtype
                    ]);
                }

                $lastactuatorid++;
            } 
        }

        $ecu = Ecu_list::all();
        return view('ecus.ecus', compact('ecu'));
    }

    public function lastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        
        $lastId = 0 + $machine->machineId;
        
        return $lastId; // Asi anda la vista     
    }

    public function lastActuatorsId()
    {
        $lastactuators = Actuators::select('actuatorsId')->orderByDesc('actuatorsId')->first();
        
        if($lastactuators){
            $lastactuatorId = 1 + $lastactuators->actuatorsId;
        }else{
            $lastactuatorId = 1;
        }
     
        return $lastactuatorId;
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\RelacionEcus;
use App\Models\Actuators;
use App\Models\actuators_ecuoutputs;
use App\Models\Actuators_Sensors;
use App\Models\Ecus;
use App\Models\Sensors;
use App\Models\Sensors_ecuinputs;
use Illuminate\Http\Request;
use App\Models\MachineData;
use App\Models\Plantingtypes;
use Illuminate\Support\Facades\DB;

class RelacionEcusController extends Controller
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
        $machineId = $this->lastid();

        $actuators = Actuators::where('machineId', $machineId)->orderBy('actuatorsId', 'asc')->get();
        $sensors = Sensors::where('machineId', $machineId)->orderBy('sensorid', 'asc')->get();
        $ecus = Ecus::where('machineId', $machineId)->orderBy('ecuId', 'asc')->get();

        $ecujoin = Ecus::all()->where('machineId',$machineId);

        $sensorjoin = DB::table('sensors')
        ->join('sensors_list','sensors_list.sensorslist_Id', '=', 'sensors.sensorslist_Id')
        ->where('sensors.machineId',$machineId)
        ->get();

        return view('relacionecus.relacionecus')
               ->with('sensors', $sensors)
               ->with('actuators', $actuators)
               ->with('ecujoin', $ecujoin)
               ->with('sensorjoin', $sensorjoin)
               ->with('ecus', $ecus); 

    }
    
    public function setConfigs(Request $request)
    {
        $machineId           = $this->lastid();
        $lastEcusActuatorsId = $this->lastEcusOutActuatorsId();
        $lastEcusActId       = $this->lastEcusActuatorsId();
        //Cuantos actuadores tengo ?
        $actuadoresLimite   = Actuators::where('machineId', $machineId)->count();

        //Agarra el primer id y fijate si esta chequeado
        $queryFirts    = Actuators::where('machineId', $machineId)->orderBy('actuatorsId', 'asc')->first();
        $actuadorFirts = 0 + $queryFirts->actuatorsId;
        //dd($actuadorFirts);
        $queryConsult  = Actuators::where('actuatorsId',$actuadorFirts)->first();
        $resultType    = 0 + $queryConsult->actuatorType;
        for($x=1;$x<=$actuadoresLimite;$x++){

        $actuatorCheck  = $request->input($actuadorFirts);
       
        $acttubirnetype = 0;

            if($resultType = 3){

                $turVacioCheck  = $request->input($actuadorFirts.'-VACIO');//$_POST[$actuadorFirts.'-VACIO'];
                if($turVacioCheck){
                    $acttubirnetype = 1;
                }
                $turSopladoCheck= $request->input($actuadorFirts.'-SOPLADO');//$_POST[$actuadorFirts.'-SOPLADO'];
                if($turSopladoCheck){
                    $acttubirnetype = 0;
                }
            }else{
                $turVacioCheck = false;
                $turSopladoCheck = false;
            }
            //Que ecu selecciona
            $queryEcusConsult    = Ecus::select('ecuId')->where('machineId', $machineId)->orderBy('ecuId', 'asc')->first();
            $queryEcusLastConsult= Ecus::select('ecuId')->where('machineId', $machineId)->orderBy('ecuId', 'desc')->first();
            $queryEcuCount       = 0 + $queryEcusLastConsult->ecuId;
        
            $ecuCheck = 0;
            $ecuFirst = 0 + $queryEcusConsult->ecuId;
            
            for($e=$ecuFirst;$e<=$queryEcuCount;$e++){
                $ecuChecked =  $request->input($actuadorFirts.'-'.$e);
                
                if($ecuChecked){
                    $ecuCheck = $ecuCheck + $e;
                    
                }
            }

            //Salidas de la Ecu
            $outnumber      = 0;
            
            $outputCheck    = $request->input($actuadorFirts.'OUTPUT');
            if($outputCheck){
                $outnumber = $outnumber + $outputCheck;
                //dd($outnumber);
            }
            
            //Tipo de Salida
            $outputType = 0;
            $outPuenteTypeCheck = $request->input($actuadorFirts.'-PUENTE-H');
            if($outPuenteTypeCheck){
                $outputType = 1;
            }
            $outDigitalTypeCheck= $request->input($actuadorFirts.'-DIGITAL');
            if($outPuenteTypeCheck){
                $outputType = 0;
            }
            // Si el actuador esta invertido
            $actInvertedCheck   = $request->input($actuadorFirts.'-inverted');
            $outInvertedCheck   = 0;
            if($actInvertedCheck){
                $outInvertedCheck   = 1;
            }
            //dd($turVacioCheck,$turSopladoCheck,$ecuCheck,$outnumber,$outPuenteTypeCheck,$outDigitalTypeCheck,$outInvertedCheck);

            if($actuatorCheck){
                //dd($machineId, $lastEcusActuatorsId, $lastEcusActId, $actuadorFirts,$ecuCheck,$outnumber,$turVacioCheck,$turSopladoCheck,$outputType,$outInvertedCheck);
                $actuatorEcuOutputs  = $this->actuatorEcuConfigs($machineId, $lastEcusActuatorsId, $lastEcusActId, $actuadorFirts,$ecuCheck,$outnumber,$turVacioCheck,$turSopladoCheck,$outputType,$outInvertedCheck);
            }
            $actuadorFirts ++;
            //dd($actuadorFirts);
            $lastEcusActuatorsId ++;
            $lastEcusActId ++;
        }
         //////////////////////////////////////////
        ////////SENSORS ECU INPUTS////////////////
       //////////////////////////////////////////
        $lastsenecuinId = $this->lastSensorsEcuInputsId();
        $lastactuasenId = $this->lastActuatorSensorsLastId();
        $sensorsLimite   = Sensors::where('machineId', $machineId)->count();

        $querySensorsFirts    = Sensors::where('machineId', $machineId)->orderBy('sensorid', 'asc')->first();
        $sensorFirts = 0 + $querySensorsFirts->sensorid;

        for($m=1;$m<=$sensorsLimite;$m++){
            $sensorCheck  = $request->input('S'.$sensorFirts);

            $ecuSenCheck = 0;

            for($s=$ecuFirst;$s<=$queryEcuCount;$s++){
                $ecusenChecked =  $request->input('S'.$sensorFirts.'-'.$s);
                
                if($ecusenChecked){
                    $ecuSenCheck = $ecuSenCheck + $s;
                    
                }
            }

            //ENTRADA DE LA ECU
            $inputnumber  = 0;

            $inputCheck    = $request->input($sensorFirts.'-INPUT');
            if($inputCheck){
                $inputnumber = $inputnumber + $inputCheck;
            }
            
        
            //SENSOR ACTUATOR
            $queryActuatorFirstIdConsult    = Actuators::select('actuatorsId')->where('machineId', $machineId)->orderBy('actuatorsId', 'asc')->first();
            $queryActuatorLastIdConsult     = Actuators::select('actuatorsId')->where('machineId', $machineId)->orderBy('actuatorsId', 'desc')->first();
            $actuFirstId = 0 + $queryActuatorFirstIdConsult->actuatorsId;
            $actuLastId  = 0 + $queryActuatorLastIdConsult->actuatorsId;

            $senActuatorId = 0;
            //dd($actuFirstId, $actuLastId);
            if($actuadorFirts != $actuLastId){
                
                for($d=$actuFirstId;$d<=$actuLastId;$d++){
                    $senActuatorChecked =  $request->input($sensorFirts.'-'.$d);
                    if($senActuatorChecked){
                        $senActuatorId = $senActuatorId + $d;
                    }
                }
            }else{
                $senActuatorChecked =  $request->input($sensorFirts.'-'.$actuadorFirts);
                if($senActuatorChecked){
                    $senActuatorId = $senActuatorId + $actuadorFirts;
                }else{
                    $senActuatorId = false;
                }
            }
            
            // SI EL SENSOR esta invertido
            $senInvertedCheck   = $request->input($sensorFirts.'-inverted');
            $sensorInverted  = 0;

            if($senInvertedCheck){
                $sensorInverted   = 1;
            }

            //INPUT-TYPE
            $senInputType = 0;
            for($t=0; $t<=2; $t++){
                $senInputTypeCheck = $request->input($sensorFirts.'-INPUTTYPE-'.$t);
                if($senInputTypeCheck){
                    $senInputType = $senInputType + $t;
                }
            }

            //SENSOR SUB-TYPE
            $sensorSubtype = 0;
            for($z=0; $z<=3; $z++){
                $senVeloSubTypeCheck = $request->input($sensorFirts.'-VELOCIDAD-'.$z);
                $senPreSubTypeCheck  = $request->input($sensorFirts.'-PRESION-'.$z);

                if($senVeloSubTypeCheck){
                    $sensorSubtype = $sensorSubtype + $z;
                }
                if($senPreSubTypeCheck){
                    $sensorSubtype = $sensorSubtype + $z;
                }

            }
            //CALL METHOD SENSOR
            if($sensorCheck){
                $sensorsInputConfigs = $this->sensorsInputConfigs($lastactuasenId,$machineId, $lastsenecuinId, $sensorFirts, $ecuSenCheck, $inputnumber,$senActuatorId,$senInputType, $sensorSubtype, $sensorInverted);
            }
            $sensorFirts ++;
            $lastsenecuinId ++;
            $lastactuasenId ++;
        }

        $plantingtypes = Plantingtypes::where('machineID', $machineId)->get();
        return view('plantingtypes.plantingtypes', compact('plantingtypes'));
    }

    public function actuatorEcuConfigs($machineId, $lastEcusActuatorsId, $lastEcusActId, $actuadorFirts,$ecuCheck,$outnumber,$turVacioCheck,$turSopladoCheck,$outputType,$outInvertedCheck)
    {
       //`ecuActuators` `ecusActuatorsId``ecuId``actuatorId`
       if($ecuCheck){
           DB::table('ecus_actuators')->insert([
            'ecusActuatorsId' => $lastEcusActId,
            'ecuId'    => $ecuCheck,
            'actuatorId'   => $actuadorFirts
            ]);
       }

       //`actuators_ecuoutputs` WHERE `actuators_ecuoutputsId` `machineId` `actuatorId``outputnumber``isinverted``outputtype``updated_at``created_at`
       DB::table('actuators_ecuoutputs')->insert([
        'actuators_ecuoutputsId' => $lastEcusActuatorsId,
        'machineId'    => $machineId,
        'actuatorId'   => $actuadorFirts,
        'outputnumber' => $outnumber,
        'isinverted'   => $outInvertedCheck,
        'outputtype'   => $outputType,
        'updated_at'   => now(),
        'created_at'   => now()
        ]);

        if($turVacioCheck != 0){
            DB::table('actuators')
              ->where('actuatorsId', $actuadorFirts)
              ->update([
                'subtype' => $turVacioCheck
            ]);
        }
    }

    public function sensorsInputConfigs($lastactuasenId,$machineId, $lastsenecuinId,$sensorFirts, $ecuSenCheck, $inputnumber,$senActuatorId,$senInputType, $sensorSubtype, $sensorInverted)
    {
        //actuatorSensors `actuatorsSensorsId` `actuatorId` `sensorId`
        DB::table('actuators_sensors')->insert([
            'actuatorsSensorsId' => $lastactuasenId,
            'actuatorId'    => $senActuatorId,
            'sensorId'   => $sensorFirts
            ]);
        //dd($lastactuasenId, $senActuatorId, $sensorFirts);    
        //`sensors_ecuinputs` WHERE 1 `sensors_ecuinputsId` `machineId` `ecuId` `sensorId` `inputnumber` `isinverted` `inputtype`
        DB::table('sensors_ecuinputs')->insert([
            'sensors_ecuinputsId' => $lastsenecuinId,
            'machineId'    => $machineId,
            'ecuId'   => $ecuSenCheck,
            'sensorId' => $sensorFirts,
            'inputnumber'   => $inputnumber,
            'isinverted'   => $sensorInverted,
            'inputtype'   => $senInputType
            ]);

        if($sensorSubtype != 0){
            DB::table('sensors')
              ->where('sensorid', $sensorFirts)
              ->update([
                'subtype' => $sensorSubtype
            ]);
        }
    }
    
  
    public function edit(RelacionEcus $relacionEcus)
    {
        //
    }

   
    public function update(Request $request, RelacionEcus $relacionEcus)
    {
        //
    }


    public function lastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        
        $lastId = 0 + $machine->machineId;
        
        return $lastId;
    }

    public function lastEcusOutActuatorsId()
    {
        $lastecusactuators = actuators_ecuoutputs::select('actuators_ecuoutputsId')->orderByDesc('actuators_ecuoutputsId')->first();
        
        if($lastecusactuators){
            $lastecusact = 1 + $lastecusactuators->actuators_ecuoutputsId;
        }else{
            $lastecusact = 1;
        }
       
        return $lastecusact;
    }

    public function lastEcusActuatorsId()
    {
        $lastecusact = actuators_ecuoutputs::select('actuators_ecuoutputsId')->orderByDesc('actuators_ecuoutputsId')->first();
        
        if($lastecusact){
            $lastecusactu = 1 + $lastecusact->actuators_ecuoutputsId;
        }else{
            $lastecusactu = 1;
        }
       
        return $lastecusactu;
    }
    public function lastSensorsEcuInputsId()
    {
        $lastsenecuinId = Sensors_ecuinputs::select('sensors_ecuinputsId')->orderByDesc('sensors_ecuinputsId')->first();
        
        if($lastsenecuinId){
            $lastsenecuin = 1 + $lastsenecuinId->sensors_ecuinputsId;
        }else{
            $lastsenecuin = 1;
        }
       
        return $lastsenecuin;
    }
    public function lastActuatorSensorsLastId()
    {
        $lastactuatorsensorId = Actuators_Sensors::select('actuatorsSensorsId')->orderByDesc('actuatorsSensorsId')->first();
        
        if($lastactuatorsensorId){
            $lastactuasensorId = 1 + $lastactuatorsensorId->actuatorsSensorsId;
        }else{
            $lastactuasensorId = 1;
        }
       
        return $lastactuasensorId;
    }
}

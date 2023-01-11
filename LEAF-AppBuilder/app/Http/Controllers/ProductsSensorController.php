<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MachineData;
use App\Models\Rows;
use App\Models\Products_Sensors;
use App\Models\Products;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

$row = 10;
class ProductsSensorController extends Controller
{
    //Esto es de Seguridad para que no entren con el / /
       public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
         return view('sensors.solo-monitor.sensorslineamonitor'); // aca a la vista le pedimos que nos traiga en la vista todos los registro de la variable crucianelli
    }
    public function indexfull()
    {
         return view('sensors.sensorsline'); // aca a la vista le pedimos que nos traiga en la vista todos los registro de la variable crucianelli
    }

    public function productssensor()
    {
        $machineID = $this->lastId();

        $machine = MachineData::where('machineId', $machineID)->first() ;
        
        $r = $machine->rowsQty;
        $rows = array();

        for($i=1; $i <= $r ; $i++){

            $rows[$i]= $i;
           
        }
        
        
        return view('sensors.solo-monitor.sensorslineamonitor')->with('rows', $rows); // Asi anda la vista


    }
    public function selectproducts()
    {
        $machineID = $this->lastId();

        $machine = MachineData::where('machineId', $machineID)->first() ;
        
        $r = $machine->rowsQty;
        $rows = array();

        for($i=1; $i <= $r ; $i++){

            $rows[$i]= $i;
           
        }
         return view('sensors.sensorsline')->with('rows', $rows);
    }

    public function hasmany(Request $request){
        $machineID = $this->lastId();
        $productSensorID = $this->lastProductSensorId();
        $prosenID = 0 + $productSensorID;

        // Se obtiene la maquina para sacar la cantidad de rows para la vista
        $machine = MachineData::where('machineId', $machineID)->first() ;
        
        $r = $machine->rowsQty;

        // Guarda la cantidad de sensores por row
        $cant = array();
        
            for($i = 1; $i <= $r; $i++){
                $cant[$i] = $_POST['cantidad'.$i];
            }

        // Obtengo si reporta ICS
        $switchStatus = $request->input('icsflex');
        
        $ics = 0;

        if($switchStatus){
            $ics = 1;
        }else{
            $ics = 0;
        }

        //dd($cant);
        //Insertamos en la database los rows
        $indice = 1;
        $posicion = 0;
        $limite = count($cant);
       
        for($s=1 ;$s <= $limite; $s++){
            
            if($cant[$s] > 1){
            DB::table('products__sensors')->insert([
                'productSensorsId' => $prosenID,
                'instanceId' => $posicion,
                'rowId' => $indice,
                'isMuted' => 0,
                'version' => 0,
                'reportIcs' => $ics,
                'updated_at' => now(),
                'created_at' => now()
            ]);

            DB::table('products__sensors')->insert([
                'productSensorsId' => $prosenID+1,
                'instanceId' => $posicion+1,
                'rowId' => $indice,
                'isMuted' => 0,
                'version' => 0,
                'reportIcs' => 0,
                'updated_at' => now(),
                'created_at' => now()
            ]);
            $posicion = $posicion + 2;
            $prosenID = $prosenID + 2;
            $indice++;

            }else{
                DB::table('products__sensors')->insert([
                    'productSensorsId' => $prosenID,
                    'instanceId' => $posicion,
                    'rowId' => $indice,
                    'isMuted' => 0,
                    'version' => 0,
                    'reportIcs' => $ics,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
                $prosenID ++;
                $posicion ++;
                $indice ++;
            }
            
        }
        //Updateo Globla
        DB::table('global_machineData')
              ->where('machineID', $machineID)
              ->update([
                'prosen_firstId' => $productSensorID,
                'prosen_lastId' => $prosenID
            ]);
        //productSensorsId-instanceId-rowId-isMuted-version-reportIcs
        $only = 0  + $this->onlymonlastId();
        
        if($only == 1){
            return view('actuadores.solo-monitor.actuatorsmonitor');
        }else{
            return view('defasajes.defasajes');
        }

        //return $request;
    }

    public function lastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        
        $lastId = 0 + $machine->machineId;
        
        return $lastId; // Asi anda la vista     
    }

    public function onlymonlastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        $whatonly = MachineData::where('machineId', $machine->machineId)->first();
        $only = 0 + $whatonly->onlyMonitor;
        
        return $only; // Asi anda la vista     
    }
    
    public function lastProductSensorId(){
        $getlastId = DB::table('products__sensors')->orderByDesc('productSensorsId')->first();
       
        if($getlastId){
            $lastProductSensorId = $getlastId->productSensorsId + 1;
        }else{
            $lastProductSensorId = 1;
        }
        
        return $lastProductSensorId; 
    }
    
    
}

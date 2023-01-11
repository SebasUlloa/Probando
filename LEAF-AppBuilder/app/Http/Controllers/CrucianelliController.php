<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actuators;
use App\Models\Actuators_Sections;
use App\Models\MachineData;
use App\Models\Plantingtypes;
use App\Models\Versions;
use App\Models\Products;
use App\Models\machine_company;
use App\Models\Global_Machinedata;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CrucianelliController extends Controller
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
        $category = machine_company::all();
         // Aca al agregar use app models crucianelli...podemos usar para traer todos los registros
        $crucianelli = MachineData::all();

        $pionera  = MachineData::all()->where('machineFamilyId', 2);
        $drillor  = MachineData::all()->where('machineFamilyId', 4);
        $plantor  = MachineData::all()->where('machineFamilyId', 3);
        $especial = MachineData::all()->where('machineFamilyId', 5);

        return view('crucianelli.index')
        ->with('crucianelli', $crucianelli)
        ->with('pionera', $pionera)
        ->with('drillor', $drillor)
        ->with('plantor', $plantor)
        ->with('especial', $especial)
        ->with('category', $category); // aca a la vista le pedimos que nos traiga en la vista todos los registro de la variable crucianelli
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = machine_company::all()->where('name', 'CRUCIANELLI');
        $version = Versions::all();

        return view('crucianelli.create')->with('version', $version)->with('category', $category);
    }

    public function createmonitor()
    {
        $category = machine_company::all()->where('name', 'CRUCIANELLI');
        $version = Versions::all();
        return view('crucianelli.createmonitor')->with('version', $version)->with('category', $category);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $machineID = $this->lastId();
        $globalmachineId = $this->lastGlobalId();

        $crucianelli = new MachineData();

        $onlymon = $request->input('solo-monitor');
        if($onlymon){
            $onlymon = 1;
        }else{
            $onlymon = 0;
        }
        $crucianelli->onlyMonitor = $onlymon;
        $crucianelli->machineID = $machineID;
        $crucianelli->name  = $request->get('name');
        $crucianelli->description  = $request->get('description');
        $crucianelli->rowsQty = $request->get('rowsQty');
        $crucianelli->rowsFixedDistance = $request->get('rowsFixedDistance');

        $switchDobleLinea = $request->input('doubleLineConfig');
        
        $doblelinea = 0;

        if($switchDobleLinea){
            $doblelinea = 1;
        }else{
            $doblelinea = 0;
        }

        $crucianelli->doubleLineConfig = $doblelinea;

        $version = $request->input('version');
        $crucianelli->version = $version;
        
        $machinemodel = $request->input('machine-model');
        $crucianelli->machineFamilyId = $machinemodel;

        $monitormodel = $request->input('monitor-model');
        $crucianelli->monitor_model = $monitormodel;

        $crucianelli->save();

        //globalId	machineId	prosen_firstId	prosen_lastId	prosenpro_firstId	prosenpro_lastId	offsett	rowsInOffset
        DB::table('global_machinedata')->insert([
            'globalId' => $globalmachineId,
            'machineId' => $machineID,
            'prosen_firstId' => 0,
            'prosen_lastId' => 0,
            'prosenpro_firstId' => 0,
            'prosenpro_lastId' => 0,
            'offsett' => 0,
            'rowsInOffset' => 0,
            'updated_at' => now(),
            'created_at' => now()
            ]);


        //$machineID = $crucianelli->machineID;
        if($onlymon){
            return redirect('crucianelli/productsmonitor')->with('machineID', $machineID);
        }else{
            return redirect('crucianelli/products')->with('machineID', $machineID);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($machineID)
    {
        $crucianelli = MachineData::find($machineID);
        return view('crucianelli.edit')->with('crucianelli', $machineID);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $machineID)
    {
        $crucianelli = MAchineData::find($machineID);

        $crucianelli->machineID = $request->get('machineID');
        $crucianelli->name  = $request->get('name ');
        $crucianelli->description  = $request->get('description ');
        $crucianelli->rowsQty = $request->get('rowsQty');
        $crucianelli->rowsFixedDistance = $request->get('rowsFixedDistance');
        $crucianelli->doubleLineConfig = $request->get('doubleLineConfig');
        $crucianelli->machineFamilyId = $request->get('machineFamilyId');

        $crucianelli->save();

        return redirect('/crucianelli');
    }

 
    public function destroy($machineID)
    {
        $queryActuators = Actuators::where('machineID', $machineID)->first();
        if($queryActuators){
            $actuatorId     = 0 + $queryActuators->actuatorsId;
            $actuatorsCount = Actuators::where('machineID', $machineID)->count();
            $actuatorsection= Actuators_Sections::where('actuatorsId',$actuatorId)->first();
            for($i=1;$i<=$actuatorsCount;$i++){
                $deleted7   = DB::table('actuators_rows')->where('actuatorId', $actuatorId)->delete();
                $deleted8   = DB::table('actuators_sensors')->where('actuatorId', $actuatorId)->delete();
                if($actuatorsection){
                    $deleted9   = DB::table('actuator_sections')->where('actuatorsId', $actuatorId)->delete();
                }
                $deleted10  = DB::table('ecus_actuators')->where('actuatorId', $actuatorId)->delete();
                $actuatorId++;
            }
        }
        $deleted11  = DB::table('actuators_ecuoutputs')->where('machineID', $machineID)->delete();

        $deleted2   = DB::table('sensors')->where('machineID', $machineID)->delete();
        $deleted3   = DB::table('rows_offset')->where('machineID', $machineID)->delete();
        $deleted4   = DB::table('ecus')->where('machineID', $machineID)->delete();
        $deleted5   = DB::table('actuators')->where('machineID', $machineID)->delete();
        $deleted12  = DB::table('sensors_ecuinputs')->where('machineID', $machineID)->delete();
        
        //Borrar por global
        $queryglobal   = Global_Machinedata::where('machineID', $machineID)->first();
        if($queryglobal){
            $firstproglobal= 0 + $queryglobal->prosen_firstId;
            $lastproglobal = $queryglobal->prosen_lastId - 1;
            for($g=1;$g<=$lastproglobal;$g++){
                $deleted13  = DB::table('products__sensors')->where('productSensorsId', $firstproglobal)->delete();
                $firstproglobal++;
            }
        }

        //Borrar por productId
        $queryplantingtype = Plantingtypes::where('machineID', $machineID)->first();
        if($queryplantingtype){
            $plantingtypeId    = 0 + $queryplantingtype->plantingTypeId;
            $plantingtypecount = Plantingtypes::where('machineID', $machineID)->count();
    
            for($p=1;$p<=$plantingtypecount;$p++){
                $queryproductId  = Products::where('plantingtypeId', $plantingtypeId)->orderBy('productsId', 'asc')->first(); 
                $productId       = 0 + $queryproductId->productId;

                if($productId != 0){
                    $deleted14  = DB::table('products__sensors__products')->where('productId', $productId)->delete();
                }
                $deleted15  = DB::table('sections_rows')->where('productsId', $productId)->delete();
                $deleted16  = DB::table('products')->where('plantingtypeId', $plantingtypeId)->delete();
                $plantingtypeId++;
                $productId++;
            }
        }
        
        $deleted    = DB::table('products__traffic')->where('machineID', $machineID)->delete();
        $deleted6   = DB::table('global_machinedata')->where('machineID', $machineID)->delete();
        $deleted2   = DB::table('plantingtypes')->where('machineID', $machineID)->delete();

        $crucianelli = MAchineData::find($machineID);
        $crucianelli->delete();

        return redirect('/crucianelli');
    }
/*
    public function imprimir(){
        

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }*/

    public function downloadPdf()
    {
        $crucianelli = MAchineData::all();

       view()->share('crucianelli.resumen',$crucianelli);

        $pdf = PDF::loadView('crucianelli.resumen', ['crucianelli' => $crucianelli]);

        return $pdf->download('crucianelli.pdf');
    }

    public function lastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();

        if($machine){
            $lastId = 1 + $machine->machineId;
        }else{
            $lastId = 1;
        }
        
        return $lastId; // Asi anda la vista     
    }

    public function lastGlobalId(){
        $lastglobal = Global_Machinedata::select('globalId')->orderByDesc('globalId')->first();
        
        if($lastglobal){
            $lastglobalid = 1 + $lastglobal->globalId;
        }else{
            $lastglobalid = 1;
        }
     
        return $lastglobalid;  
    }


}

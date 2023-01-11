<?php

namespace App\Http\Controllers;

use App\Models\Plantingtypes;
use App\Models\Actuators;
use App\Models\Actuators_Rows;
use App\Models\Actuators_Sections;
use App\Models\Products_Traffic;
use App\Models\MachineData;
use App\Models\Products;
use App\Models\Product_Sensors_Products;
use App\Models\Section_Rows;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PlantingtypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $machineID = $this->lastId();
        // Aca al agregar use app models crucianelli...podemos usar para traer todos los registros
        $plantingtypes = Plantingtypes::where('machineID', $machineID)->get();
        return view('plantingtypes.plantingtypes', compact('plantingtypes')); // aca a la vista le pedimos que nos traiga en la vista todos los registro de la variable crucianelli
    }

    public function create()
    {
        return view('plantingtypes.createplantingtype');
    }

    public function indexmonitor()
    {
        $machineID = $this->lastId();
        //$plantingtypes = Plantingtypes::all();
        $plantingtypes = Plantingtypes::where('machineID', $machineID)->get();
        return view('plantingtypes.solo-monitor.plantingtypesmonitor', compact('plantingtypes'));
    }

    public function createplantingmonitor()
    {
        return view('plantingtypes.solo-monitor.createplantingmonitor');
    }

    public function createplanting(Request $request)
    {
        $lastid = $this->lastPlantingId();
        $machineID = $this->lastId();

        $productmachine = Products_Traffic::where('machineId', $machineID)->get('name');

        $howrows = MachineData::where('machineId', $machineID)->first();
        $rows = $howrows->rowsQty;

        $switchdoblelinea   = $request->input('doblelinea');
        $sem   = $request->input('SEMILLA');

        return view('plantingtypes.solo-monitor.createplantingmonitor')
        ->with('lastId', $lastid)
        ->with('productmachine',$productmachine)
        ->with('rows',$rows)
        ->with('sem',$sem);
    }

    public function createfullplanting(Request $request)
    {
        
        $lastid = $this->lastPlantingId();
        $machineID = $this->lastId();

        $productmachine = Products_Traffic::where('machineId', $machineID)->get('name');

        $howrows = MachineData::where('machineId', $machineID)->first();
        $rows = $howrows->rowsQty;

        $switchdoblelinea   = $request->input('doblelinea');
        $sem   = $request->input('SEMILLA');

        return view('plantingtypes.createplantingtype')
        ->with('lastId', $lastid)
        ->with('productmachine',$productmachine)
        ->with('rows',$rows)
        ->with('sem',$sem);
    }

    public function savePlanting(Request $request)
    {
        $machineID = $this->lastId();
       

          //////////////////////////////////////////////////////////
         //              PRODUCTOS POR TIPO DE SIEMBRA           //
        //////////////////////////////////////////////////////////

        //Obtengo los campos del tipo de siembre
        $name               = $request->input('name');
        $rowDistance        = $request->input('rowDistance');
   
        $switchdoblelinea   = $request->input('doblelinea');
        $switchisactive     = $request->input('isactive');
        $switchsowingmode   = $request->input('sowing');

        //Switch Doble Linea
        $doblelinea = 0;

        if($switchdoblelinea){
            $doblelinea = 1;
        }else{
            $doblelinea = 0;
        }

        //Switch is Active
        $isactive   = 0;

        if($switchisactive){
            $isactive = 1;
        }else{
            $isactive = 0;
        }

        //Switch Chorrillo Placa
        $sowingmode = 0;

        if($switchsowingmode){
            $sowingmode = 1;
        }else{
            $sowingmode = 0;
        }

        //Obtengo el Id del ultimo tipo de siembra
        $lastid = $this->lastPlantingId();
        $lastordercode = 0 + $this->getLastOrder();

        DB::table('plantingtypes')->insert([
                'plantingTypeId' => $lastid,
                'ordercode' => $lastordercode,
                'machineId' => $machineID,
                'name' => $name,
                'doubleLineConfig' => $doblelinea,
                'rowDistance' => $rowDistance,
                'isActive' => $isactive,
                'sowingModeType' => $sowingmode,
                'updated_at' => now(),
                'created_at' => now()
                ]);    

        
        $sem            = $request->input('PROSEMILLA'); //check sem
        $seccsem        = $request->input('SECCION-SEMILLA'); //cant secc sem
        $semprincipal   = $request->input('PRISEMILLA'); //check principal

        $fert1          = $request->input('PROFERT1');
        $seccfert1      = $request->input('SECCION-FERT1');
        $fert1principal = $request->input('PRIFERT1');

        $fert2          = $request->input('PROFERT2');
        $seccfert2      = $request->input('SECCION-FERT2');
        $fert2principal = $request->input('PRIFERT2');

        $alfa           = $request->input('PROALFALFA');
        $seccalfa       = $request->input('SECCION-ALFALFA');
        $alfaprincipal  = $request->input('PRIALFALFA');
        //dd($sem, $semprincipal, $fert1); $semprincipal,$lastfert1productid,$last3productid

        $saveproducts = $this->prosenpro($machineID,$sem,$semprincipal,$fert1,$fert1principal,$fert2,$fert2principal,$alfa,$alfaprincipal);
        //dd($saveproducts);
        $seccion      = $this->plantingSeccion($sem, $fert1, $fert2, $alfa, $seccsem, $seccfert1, $seccfert2, $seccalfa);
        return redirect('crucianelli/plantingtypesmonitor');    
    }

    public function prosenpro($machineID,$sem,$semprincipal,$fert1,$fert1principal,$fert2,$fert2principal,$alfa,$alfaprincipal)
    {
          //////////////////////////////////////////////////////////
         //              PRODUCTOS POR TIPO DE SIEMBRA           //
        //////////////////////////////////////////////////////////
        $lastid = $this->lastPlantingId();
        $semmain = 0; //main
        $lastproductid = $this->lastProductId(); 
        
        if($semprincipal){
            $semmain = 1;
        }
      

        if($sem){
            DB::table('products')->insert([
                'productsId' => $lastproductid,
                'plantingTypeId' => $lastid,
                'name' => 'SEMILLA',
                'sections' => 1,
                'actuatorsCombType' => 0,
                'enable' => 1,
                'productType' => 0,
                'main' => $semmain,
                'updated_at' => now(),
                'created_at' => now()
                ]);
           
        }
        ////////////////////////////////////////////////////
        $fer1main = 0;
        
        if($fert1principal){
            $fer1main = 1;
        }
      
        $lastfert1productid = $lastproductid + 1;
        $lastfert2productid = $lastfert1productid;

        if($fert1){
           DB::table('products')->insert([
                'productsId' => $lastfert1productid,
                'plantingTypeId' => $lastid,
                'name' => 'FERT.1',
                'sections' => 1,
                'actuatorsCombType' => 0,
                'enable' => 1,
                'productType' => 1,
                'main' => $fer1main,
                'updated_at' => now(),
                'created_at' => now()
                ]);
        }
        ////////////////////////////////////////////////////
        $fer2main = 0;
        
        if($fert2principal){
            $fer2main = 1;
        }
      

        if($fert2){
           $lastfert2productid = $lastfert1productid + 1;

           DB::table('products')->insert([
                'productsId' => $lastfert2productid,
                'plantingTypeId' => $lastid,
                'name' => 'FERT.2',
                'sections' => 1,
                'actuatorsCombType' => 0,
                'enable' => 1,
                'productType' => 2,
                'main' => $fer2main,
                'updated_at' => now(),
                'created_at' => now()
                ]);
        }
        //////////////////////////////////////////////////////
        $alfamain = 0;

        if($alfaprincipal){
            $alfamain = 1;
        }

        //Products
        if($alfa){
            $last3productid = $lastfert2productid + 1;

            DB::table('products')->insert([
                'productsId' => $last3productid,
                'plantingTypeId' => $lastid,
                'name' => 'ALFALFA',
                'sections' => 1,
                'actuatorsCombType' => 0,
                'enable' => 1,
                'productType' => 2,
                'main' => $alfamain,
                'updated_at' => now(),
                'created_at' => now()
                ]);
        }
       
    

          //////////////////////////////////////////////////////////
         //              PRODUCTOS SENSOR PRODUCTS               //
        //////////////////////////////////////////////////////////
        $prosenproId = $this->lastProductSensorProductId();
        $lastproductid = $this->lastProductId(); 
        $lastprodsensprod = 0 + $prosenproId;

        //SEMILLA
        $row = $this->getRows();
        $botsem = array();
        for($i = 1; $i <= $row; $i++){
        
            if (isset($_POST['SEM'.$i])) {
                $botsem[$i] = true;

                DB::table('product__Sensors__Products')->insert([
                    'productSensorProductsId' => $lastprodsensprod,
                    'sensorId' => $i,
                    'productId' => $lastproductid-2,
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);

                    $lastprodsensprod++;
                } else {
                    $botsem[$i] = false;
                }
        }
        
        //ALFALFA
        $botalfa = array();
        if($alfaprincipal){
            for($i = 1; $i <= $row; $i++){
            //aca creo que es el lio
                if (isset($_POST['ALFA'.$i])) {
                    $botalfa[$i] = true;
    
                    if($alfaprincipal){
                    DB::table('product__Sensors__Products')->insert([
                        'productSensorProductsId' => $lastprodsensprod,
                        'sensorId' => $i,
                        'productId' => $last3productid,
                        'updated_at' => now(),
                        'created_at' => now()
                        ]);
    
                        $lastprodsensprod++;
                    }
                } else {
                    $botalfa[$i] = false;
                }
            }
        }

        //FERTILIZANTE 1 $semprincipal,$lastfert1productid,$last3productid
        $botfertu = array();
        $final = 1 + count($botsem);
        
        for($i = 1; $i <= $row; $i++){
        
            if (isset($_POST['FERTU'.$i])) {
                $botfertu[$i] = true;
               

                if($semprincipal){
                DB::table('product__Sensors__Products')
                            ->where('sensorId', $i+1)
                            ->update(['productId' => $lastfert1productid]);

                

                DB::table('product__Sensors__Products')->insert([
                    'productSensorProductsId' => $lastprodsensprod,
                    'sensorId' => $final,
                    'productId' => $lastproductid-2,
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);

                    $final++;
                    $lastprodsensprod++;
                            
                }else{
                  
                }
        
            } else {
                $botfertu[$i] = false;
            }
        }
        /*
        //FERTILIZANTE 2
        $botfertd = array();
        for($i = 1; $i <= $row; $i++){
        
            if (isset($_POST['FERTD'.$i])) {
                $botfertd[$i] = true;
                DB::table('product__Sensors__Products')
                    ->where('sensorId', $i)
                    ->update(['productId' => $lastfert2productid]);
            } else {
                $botfertd[$i] = false;
            }
        }
        */
        //Updateo Global
        DB::table('global_machineData')
              ->where('machineID', $machineID)
              ->update([
                'prosenpro_firstId' => $prosenproId,
                'prosenpro_lastId' => $lastprodsensprod
            ]);
        
        //productSensorProductsId	sensorId	productId
    }

    public function savefullPlanting(Request $request)
    {
        $machineID = $this->lastId();
       

          //////////////////////////////////////////////////////////
         //              PRODUCTOS POR TIPO DE SIEMBRA           //
        //////////////////////////////////////////////////////////

        //Obtengo los campos del tipo de siembre
        $name               = $request->input('name');
        $rowDistance        = $request->input('rowDistance');
   
        $switchdoblelinea   = $request->input('doblelinea');
        $switchisactive     = $request->input('isactive');
        $switchsowingmode   = $request->input('sowing');

        //Switch Doble Linea
        $doblelinea = 0;

        if($switchdoblelinea){
            $doblelinea = 1;
        }else{
            $doblelinea = 0;
        }

        //Switch is Active
        $isactive   = 0;

        if($switchisactive){
            $isactive = 1;
        }else{
            $isactive = 0;
        }

        //Switch Chorrillo Placa
        $sowingmode = 0;

        if($switchsowingmode){
            $sowingmode = 1;
        }else{
            $sowingmode = 0;
        }

        //Obtengo el Id del ultimo tipo de siembra
        $lastid = $this->lastPlantingId();
        $lastordercode = 0 + $this->getLastOrder();

        DB::table('plantingtypes')->insert([
                'plantingTypeId' => $lastid,
                'ordercode' => $lastordercode,
                'machineId' => $machineID,
                'name' => $name,
                'doubleLineConfig' => $doblelinea,
                'rowDistance' => $rowDistance,
                'isActive' => $isactive,
                'sowingModeType' => $sowingmode,
                'updated_at' => now(),
                'created_at' => now()
                ]);    

        
        $sem            = $request->input('PROSEMILLA'); //check sem
        $seccsem        = $request->input('SECCION-SEMILLA'); //cant secc sem
        $semprincipal   = $request->input('PRISEMILLA'); //check principal

        $fert1          = $request->input('PROFERT1');
        $seccfert1      = $request->input('SECCION-FERT1');
        $fert1principal = $request->input('PRIFERT1');

        $fert2          = $request->input('PROFERT2');
        $seccfert2      = $request->input('SECCION-FERT2');
        $fert2principal = $request->input('PRIFERT2');

        $alfa           = $request->input('PROALFALFA');
        $seccalfa       = $request->input('SECCION-ALFALFA');
        $alfaprincipal  = $request->input('PRIALFALFA');
        //dd($sem, $semprincipal, $fert1); $semprincipal,$lastfert1productid,$last3productid

        $saveproducts = $this->prosenprofull($machineID,$sem,$semprincipal,$fert1,$fert1principal,$fert2,$fert2principal,$alfa,$alfaprincipal,$seccsem, $seccfert1, $seccfert2, $seccalfa);
        //dd($saveproducts);

        $getrows       = MachineData::where('machineId', $machineID)->first();
        $rows          = $getrows->rowsQty;
        $actuators     = Actuators::where('machineId', $machineID)->orderBy('actuatorsId', 'asc')->get();
        $products      = Products::where('plantingtypeId', $lastid)->orderBy('productsId', 'asc')->get();
        
        $rowarray      = array();
        for($k=1;$k<=$rows;$k++){
            $rowarray[$k] = 'SURCO-'.$k;
        }
        //dd($rowarray);
        //$queryseccion       = Products::where('plantingtypeId', $lastid)->first();
        $seccion            = 0 + $seccsem;
        return view('plantingtypes.seccionplantingtype', compact('actuators','rows', 'products','seccion','rowarray'));
    }

    public function prosenprofull($machineID,$sem,$semprincipal,$fert1,$fert1principal,$fert2,$fert2principal,$alfa,$alfaprincipal,$seccsem, $seccfert1, $seccfert2, $seccalfa)
    {
          //////////////////////////////////////////////////////////
         //              PRODUCTOS POR TIPO DE SIEMBRA           //
        //////////////////////////////////////////////////////////
        $lastid = $this->lastPlantingId() - 1;
        $semmain = 0; //main
        $lastproductid = $this->lastProductId(); 
        
        if($semprincipal){
            $semmain = 1;
        }
      

        if($sem){
            DB::table('products')->insert([
                'productsId' => $lastproductid,
                'plantingTypeId' => $lastid,
                'name' => 'SEMILLA',
                'sections' => $seccsem,
                'actuatorsCombType' => 0,
                'enable' => 1,
                'productType' => 0,
                'main' => $semmain,
                'updated_at' => now(),
                'created_at' => now()
                ]);
           
        }
        ////////////////////////////////////////////////////
        $fer1main = 0;
        
        if($fert1principal){
            $fer1main = 1;
        }
      
        $lastfert1productid = $lastproductid + 1;
        $lastfert2productid = $lastfert1productid;

        if($fert1){
           DB::table('products')->insert([
                'productsId' => $lastfert1productid,
                'plantingTypeId' => $lastid,
                'name' => 'FERT.1',
                'sections' => $seccfert1,
                'actuatorsCombType' => 0,
                'enable' => 1,
                'productType' => 1,
                'main' => $fer1main,
                'updated_at' => now(),
                'created_at' => now()
                ]);
        }
        ////////////////////////////////////////////////////
        $fer2main = 0;
        
        if($fert2principal){
            $fer2main = 1;
        }
      

        if($fert2){
           $lastfert2productid = $lastfert1productid + 1;

           DB::table('products')->insert([
                'productsId' => $lastfert2productid,
                'plantingTypeId' => $lastid,
                'name' => 'FERT.2',
                'sections' => $seccfert2,
                'actuatorsCombType' => 0,
                'enable' => 1,
                'productType' => 2,
                'main' => $fer2main,
                'updated_at' => now(),
                'created_at' => now()
                ]);
        }
        //////////////////////////////////////////////////////
        $alfamain = 0;

        if($alfaprincipal){
            $alfamain = 1;
        }

        //Products
        if($alfa){
            $last3productid = $lastfert2productid + 1;

            DB::table('products')->insert([
                'productsId' => $last3productid,
                'plantingTypeId' => $lastid,
                'name' => 'ALFALFA',
                'sections' => $seccalfa,
                'actuatorsCombType' => 0,
                'enable' => 1,
                'productType' => 2,
                'main' => $alfamain,
                'updated_at' => now(),
                'created_at' => now()
                ]);
        }
          //////////////////////////////////////////////////////////
         //              PRODUCTOS SENSOR PRODUCTS               //
        //////////////////////////////////////////////////////////
        $prosenproId = $this->lastProductSensorProductId();
        $lastproductid = $this->lastProductId(); 
        $lastprodsensprod = 0 + $prosenproId;

        //SEMILLA
        $row = $this->getRows();
        $botsem = array();
        for($i = 1; $i <= $row; $i++){
        
            if (isset($_POST['SEM'.$i])) {
                $botsem[$i] = true;

                DB::table('product__Sensors__Products')->insert([
                    'productSensorProductsId' => $lastprodsensprod,
                    'sensorId' => $i,
                    'productId' => $lastproductid-2,
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);

                    $lastprodsensprod++;
                } else {
                    $botsem[$i] = false;
                }
        }
        
        //ALFALFA
        $botalfa = array();
        if($alfaprincipal){
            for($i = 1; $i <= $row; $i++){
            //aca creo que es el lio
                if (isset($_POST['ALFA'.$i])) {
                    $botalfa[$i] = true;
    
                    if($alfaprincipal){
                    DB::table('product__Sensors__Products')->insert([
                        'productSensorProductsId' => $lastprodsensprod,
                        'sensorId' => $i,
                        'productId' => $last3productid,
                        'updated_at' => now(),
                        'created_at' => now()
                        ]);
    
                        $lastprodsensprod++;
                    }
                } else {
                    $botalfa[$i] = false;
                }
            }
        }

        //FERTILIZANTE 1 $semprincipal,$lastfert1productid,$last3productid
        $botfertu = array();
        $final = 1 + count($botsem);
        
        for($i = 1; $i <= $row; $i++){
        
            if (isset($_POST['FERTU'.$i])) {
                $botfertu[$i] = true;
               

                if($semprincipal){
                DB::table('product__Sensors__Products')
                            ->where('sensorId', $i+1)
                            ->update(['productId' => $lastfert1productid]);

                

                DB::table('product__Sensors__Products')->insert([
                    'productSensorProductsId' => $lastprodsensprod,
                    'sensorId' => $final,
                    'productId' => $lastproductid-2,
                    'updated_at' => now(),
                    'created_at' => now()
                    ]);

                    $final++;
                    $lastprodsensprod++;
                            
                }else{
                  
                }
        
            } else {
                $botfertu[$i] = false;
            }
        }

        //Updateo Global
        DB::table('global_machineData')
              ->where('machineID', $machineID)
              ->update([
                'prosenpro_firstId' => $prosenproId,
                'prosenpro_lastId' => $lastprodsensprod
            ]);

    }

    public function plantingSeccion()
    {
        $machineID = $this->lastPlantingId();
        $platingId = $this->lastId();

        $products   = Products::where('plantingtypeId', $platingId)->orderBy('productsId', 'asc')->get();
        $rows       = MachineData::where('machineId', $machineID)->first();
        $actuators  = Actuators::where('machineId', $machineID)->orderBy('actuatorsId', 'asc')->get();

        return view('plantingtypes.seccionplantingtype', compact('actuators','rows','products'));
    }
    public function saveSeccion(Request $request)
    {
        $exit                   = 0;
        $platingId              = $this->lastPlantingId() - 1;
        $machineID              = $this->lastId();
        $lastactuartorsectionId = $this->lastActuatorSections();
        $lastactuartorrowId     = $this->lastActuatorRows();
        $lastsectionrowId       = $this->lastSectionRows();
        
        $queryfirstActuators    =  Actuators::where('machineId', $machineID)->orderBy('actuatorsId', 'asc')->first();
        $firstActuators         = 0 + $queryfirstActuators->actuatorsId;

        $actuadoresLimite       = Actuators::where('machineId', $machineID)->where('actuatorType','!=',3)->count();

        $queryrowslimit         = MachineData::where('machineId',$machineID)->first();
        $rowslimit              = 0 + $queryrowslimit->rowsQty;
        //dd($platingId);
        $querycountproducts     = Products::where('plantingtypeId', $platingId)->count();
        $queryfirstproduct      = Products::where('plantingtypeId', $platingId)->orderBy('productsId', 'asc')->first();
        //dd($queryfirstproduct);
        $productsfirst          = 0 + $queryfirstproduct->productsId;
        
        $seccionproducts        = 0 + $queryfirstproduct->sections;
        $seccionindex           = 0;
        $indice                 = 1;
        
        $prod1 = 0;
        $prod2 = 0;
        $prod3 = 0;
        $prod4 = 0;

        //Products
        for($p=1;$p<=$querycountproducts;$p++){
            if($p=1){
                $prod1 = $prod1 + $productsfirst;
            }
            if($p=2){
                $prod2 = $prod2 + $productsfirst + 1;
            } 
            if($p=3){
                $prod3 = $prod3 + $productsfirst + 2;
            }
            if($p=4){
                $prod4 = $prod4 + $productsfirst + 3;
            } 
        }
        $testactuador = array();
        $testproducts = array();
        $testseccion  = array();
        $testsurcos   = array();
        $testasd      = array();
        
        for($i=1;$i<=$actuadoresLimite;$i++){
            // Checkbox actuador  ACTUA-6
            $actuatorCheck        = $request->input('ACTUA-'.$firstActuators);
            if($actuatorCheck){
                // Checkbox producto  PROD-6-15
                    $prodCheck1  = $request->input('PROD-'.$firstActuators.'-'.$prod1);
                    $prodCheck2  = $request->input('PROD-'.$firstActuators.'-'.$prod2);
                    $prodCheck3  = $request->input('PROD-'.$firstActuators.'-'.$prod3);
                    $prodCheck4  = $request->input('PROD-'.$firstActuators.'-'.$prod4);

                    if($prodCheck1){
                        $testproducts[$i] = $prod1;
                        for($s=1;$s<=$seccionproducts;$s++){
                            //	Checkbox seccion   SEC-6-1
                            $semCheck     = $request->input('SEC-'.$firstActuators.'-'.$s);
                            if($semCheck){
                                $testseccion[$i] = $s;
                                $botsurco = array();
                                
                                //Actuator_sections `actuatorsectionsid``productsId``actuatorsId``sectionNumber`
                                DB::table('actuator_sections')->insert([
                                'actuatorsectionsid' => $lastactuartorsectionId,
                                'productsId' => $prod1,
                                'actuatorsId' => $firstActuators,
                                'sectionNumber' => $s,
                                'machineId' => $machineID
                                ]);

                                $lastactuartorsectionId++;

                                for($r=1;$r<=$rowslimit;$r++){
                                    // Checkbox surco		SURCO21
                                    $surcoCheck = $request->input('SURCO'.$indice.$r);
                                    //dd($surcoCheck,$r);
                                    if($surcoCheck){
                                        $testasd[$i] = 'pro1';
                                        $botsurco[$r] =  $r;
                                        
                                        //`actuators_rows` WHERE `actuatorsrowsId``actuatorId``rowId`
                                        DB::table('actuators_rows')->insert([
                                            'actuatorsrowsId' => $lastactuartorrowId,
                                            'actuatorId' => $firstActuators,
                                            'rowId' => $r
                                            ]);
                                        //`sections_rows` `sectionrowsid``productsId``sectionNumber``rowId`
                                        DB::table('sections_rows')->insert([
                                            'sectionrowsid' => $lastsectionrowId,
                                            'productsId' => $prod1,
                                            'sectionNumber' => $s,
                                            'rowId' => $r
                                            ]);

                                        $lastactuartorrowId ++;
                                        $lastsectionrowId ++;
                                    }else{
                                        $botsurco[$r] =  null;
                                    }
                                }
                                $indice++;
                            }
                        }
                        $indice = 2;
                    }
                    if($prodCheck2){
                        $testproducts[$i] = $prod2;
                        for($s=1;$s<=$seccionproducts;$s++){
                            //	Checkbox seccion   SEC-6-1
                            $semCheck     = $request->input('SEC-'.$firstActuators.'-'.$s);
                            if($semCheck){
                                $testseccion[$i] = $s;
                                $botsurco = array();
                                
                                //Actuator_sections `actuatorsectionsid``productsId``actuatorsId``sectionNumber`
                                DB::table('actuator_sections')->insert([
                                'actuatorsectionsid' => $lastactuartorsectionId,
                                'productsId' => $prod2,
                                'actuatorsId' => $firstActuators,
                                'sectionNumber' => $s,
                                'machineId' => $machineID
                                ]);

                                $lastactuartorsectionId++;
                                for($a=1;$a<=$rowslimit;$a++){
                                    // Checkbox surco		SURCO21
                                    $surcoCheck = $request->input('SURCO'.$indice.$a);
                                    //dd($surcoCheck);
                                    $testasd[$i] = 'pro2';
                                    if($surcoCheck){
                                        $botsurco[$a] =  $a;
                                        //`actuators_rows` WHERE `actuatorsrowsId``actuatorId``rowId`
                                        DB::table('actuators_rows')->insert([
                                            'actuatorsrowsId' => $lastactuartorrowId,
                                            'actuatorId' => $firstActuators,
                                            'rowId' => $a
                                            ]);
                                        //`sections_rows` `sectionrowsid``productsId``sectionNumber``rowId`
                                        DB::table('sections_rows')->insert([
                                            'sectionrowsid' => $lastsectionrowId,
                                            'productsId' => $prod2,
                                            'sectionNumber' => $s,
                                            'rowId' => $a
                                            ]);

                                        $lastactuartorrowId ++;
                                        $lastsectionrowId ++;
                                    }else{
                                        $botsurco[$a] =  null;
                                    }
                                }
                                $indice = $indice + 1;
                            }
                        }
                    }
                    if($prodCheck3){
                        $testproducts[$i] = $prod3;
                        for($s=1;$s<=$seccionproducts;$s++){
                            //	Checkbox seccion   SEC-6-1
                            $semCheck     = $request->input('SEC-'.$firstActuators.'-'.$s);
                            if($semCheck){
                                $testseccion[$i] = $s;
                                $botsurco = array();
                                
                                //Actuator_sections `actuatorsectionsid``productsId``actuatorsId``sectionNumber`
                                DB::table('actuator_sections')->insert([
                                'actuatorsectionsid' => $lastactuartorsectionId,
                                'productsId' => $prod3,
                                'actuatorsId' => $firstActuators,
                                'sectionNumber' => $s,
                                'machineId' => $machineID
                                ]);

                                $lastactuartorsectionId++;

                                for($r=1;$r<=$rowslimit;$r++){
                                    // Checkbox surco		SURCO21
                                    $surcoCheck = $request->input('SURCO'.$indice.$r);
                                    if($surcoCheck){
                                        $testasd[$i] = 'pro3';
                                        $botsurco[$r] =  $r;
                                        
                                        //`actuators_rows` WHERE `actuatorsrowsId``actuatorId``rowId`
                                        DB::table('actuators_rows')->insert([
                                            'actuatorsrowsId' => $lastactuartorrowId,
                                            'actuatorId' => $firstActuators,
                                            'rowId' => $r
                                            ]);
                                        //`sections_rows` `sectionrowsid``productsId``sectionNumber``rowId`
                                        DB::table('sections_rows')->insert([
                                            'sectionrowsid' => $lastsectionrowId,
                                            'productsId' => $prod3,
                                            'sectionNumber' => $s,
                                            'rowId' => $r
                                            ]);

                                        $lastactuartorrowId ++;
                                        $lastsectionrowId ++;
                                    }else{
                                        $botsurco[$r] =  null;
                                    }
                                }
                                $indice++;
                            }
                        }
                    }
                    if($prodCheck4){
                        $testproducts[$i] = $prod4;
                        for($s=1;$s<=$seccionproducts;$s++){
                            //	Checkbox seccion   SEC-6-1
                            $semCheck     = $request->input('SEC-'.$firstActuators.'-'.$s);
                            if($semCheck){
                                $testseccion[$i] = $s;
                                $botsurco = array();
                                
                                //Actuator_sections `actuatorsectionsid``productsId``actuatorsId``sectionNumber`
                                DB::table('actuator_sections')->insert([
                                'actuatorsectionsid' => $lastactuartorsectionId,
                                'productsId' => $prod4,
                                'actuatorsId' => $firstActuators,
                                'sectionNumber' => $s,
                                'machineId' => $machineID
                                ]);

                                $lastactuartorsectionId++;

                                for($r=1;$r<=$rowslimit;$r++){
                                    // Checkbox surco		SURCO21
                                    $surcoCheck = $request->input('SURCO'.$indice.$r);
                                    if($surcoCheck){
                                        $testasd[$i] = 'pro3';
                                        $botsurco[$r] =  $r;
                                        
                                        //`actuators_rows` WHERE `actuatorsrowsId``actuatorId``rowId`
                                        DB::table('actuators_rows')->insert([
                                            'actuatorsrowsId' => $lastactuartorrowId,
                                            'actuatorId' => $firstActuators,
                                            'rowId' => $r
                                            ]);
                                        //`sections_rows` `sectionrowsid``productsId``sectionNumber``rowId`
                                        DB::table('sections_rows')->insert([
                                            'sectionrowsid' => $lastsectionrowId,
                                            'productsId' => $prod4,
                                            'sectionNumber' => $s,
                                            'rowId' => $r
                                            ]);

                                        $lastactuartorrowId ++;
                                        $lastsectionrowId ++;
                                    }else{
                                        $botsurco[$r] =  null;
                                    }
                                }
                                $indice++;
                            }
                        }
                    }
                
                    $firstActuators++;                  
            }else{
                $firstActuators++; 
            }
        }
        //$indice = 0;
       
        $plantingtypes = Plantingtypes::where('machineId', $machineID)->get();
       
        return view('plantingtypes.plantingtypes', compact('plantingtypes'));
       
    }

    public function prueba(Request $request)
    {
        $surcoCheck2 = $request->input('1-2');
        $id = $_POST["id"];
        dd($surcoCheck2);
    }
    public function modalIndex(Request $request)
    {
        return view('plantingtypes.modalplantingtype');
    }

    public function show(Request $request)
    {
      //
    }

  
    public function edit(Plantingtypes $plantingtypes)
    {
        //
    }

    
    public function update(Request $request, Plantingtypes $plantingtypes)
    {
        //
    }

    public function destroy($plantingtypes)
    {
        $plantingtypes = Plantingtypes::where('plantingTypeId',$plantingtypes)->delete();

        return redirect('/plantingtypes');
    }

        //////////////////////////////////////////////////////////////////////////////////
       /////////////////////////////////////////////////////////////////////////////////
      /////////////////    METODOS PARA OBTENER ULTIMOS IDS       ////////////////////
     ///////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////

    
    public function lastPlantingId()
    {
        $lastplan = Plantingtypes::select('plantingTypeId')->orderByDesc('plantingTypeId')->first();

        if($lastplan){
            $lastId = 1 + $lastplan->plantingTypeId;
        }else{
            $lastId = 1;
        }
        return $lastId;
    }

    public function getRows()
    {
        $machineID = $this->lastId();

        $howrows = MachineData::where('machineId',  $machineID)->first();
        $rows = $howrows->rowsQty;

        return $rows;
    }

    public function getLastOrder()
    {
        $machineID = $this->lastId();

        $lastorder = Plantingtypes::select('ordercode')->where('machineID', $machineID)->orderByDesc('plantingTypeId')->first();
       
        if($lastorder){
            $order = 1 + $lastorder->ordercode;
        }else{
            $order = 1;
        }
       
        return $order;
    }

    public function lastProductId()
    {
        $lastpro = Products::select('productsId')->orderByDesc('productsId')->first();
        
        if($lastpro){
            $lastprodd = 1 + $lastpro->productsId;
        }else{
            $lastprodd = 1;
        }
        return $lastprodd;
    }

    public function lastProductSensorProductId()
    {
        $lastprosenpro = Product_Sensors_Products::select('productSensorProductsId')->orderByDesc('productSensorProductsId')->first();
        
        if($lastprosenpro){
            $lastprodsensprod = 1 + $lastprosenpro->productSensorProductsId;
        }else{
            $lastprodsensprod = 1;
        }
     
        return $lastprodsensprod;
    }

    public function lastId()
    {
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        
        $lastId = 0 + $machine->machineId;
        
        return $lastId; // Asi anda la vista     
    }

    public function lastActuatorSections()
    {
        $lastactuatorsections = Actuators_Sections::select('actuatorsectionsid')->orderByDesc('actuatorsectionsid')->first();
        
        if($lastactuatorsections){
            $lastactuatorsection = 1 + $lastactuatorsections->actuatorsectionsid;
        }else{
            $lastactuatorsection = 1;
        }
     
        return $lastactuatorsection;
    }
    public function lastActuatorRows()
    {
        $lastactuatorrows = Actuators_Rows::select('actuatorsrowsId')->orderByDesc('actuatorsrowsId')->first();
        
        if($lastactuatorrows){
            $lastactuatorrow = 1 + $lastactuatorrows->actuatorsrowsId;
        }else{
            $lastactuatorrow = 1;
        }
        
        return $lastactuatorrow;
    }
    public function lastSectionRows()
    {
        $lastseccionrows = Section_Rows::select('sectionrowsid')->orderByDesc('sectionrowsid')->first();
        
        if($lastseccionrows){
            $lastseccionrow = 1 + $lastseccionrows->sectionrowsid;
        }else{
            $lastseccionrow = 1;
        }
     
        return $lastseccionrow;
    }
}

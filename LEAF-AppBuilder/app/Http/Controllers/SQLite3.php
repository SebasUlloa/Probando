<?php

namespace App\Http\Controllers;

use App\Models\MachineData;
use App\Models\Global_Machinedata;
use App\Models\Products;
use App\Models\Products_Sensors;
use App\Models\Product_Sensors_Products;
use App\Models\Products_Traffic;
use App\Models\Plantingtypes;
use App\Models\Actuators;
use App\Models\Actuators_Rows;
use App\Models\Actuators_Sections;
use App\Models\Actuators_Sensors;
use App\Models\actuators_ecuoutputs;
use App\Models\Ecus;
use App\Models\Ecus_Actuators;
use App\Models\Rows_offsets;
use App\Models\Sensors;
use App\Models\Sensors_ecuinputs;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CrucianelliController;
use Illuminate\Http\Request;
use PDO, PDOException;



class SQLite3 extends Controller
{
        private $DB;
        public $destino = 'C:\wamp64\www\LEAF-AppBuilder\public\leaf.sqlite';
    
        public function generar($machineID)
        {
            if(!is_dir($this->destino)){
                @mkdir($this->destino, 0777, true);
            }
    
            //$this->destino .= 'leaf.sqlite';
    
            if(is_file($this->destino.'leaf.sqlite')){
                unlink($this->destino.'leaf.sqlite');
            }
            
            $myfile = fopen($this->destino, "w+") or die("Unable to open file!");
            
            fclose($myfile);
            
            try {
                //$this->DB = new SQLite3($this->destino.'leaf.db', SQLITE3_OPEN_CREATE);
                $this->DB = new PDO('sqlite:'.$this->destino);
                $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                
                //$this->DB->query($sql);
                $this->DB->query("CREATE TABLE IF NOT EXISTS machineData (machineId INTEGER NOT NULL UNIQUE, name TEXT NOT NULL, description TEXT NOT NULL, rowsQty INTEGER NOT NULL DEFAULT 0, rowsFixedDistance REAL NOT NULL DEFAULT 0, doubleLineConfig INTEGER NOT NULL DEFAULT 0, machineFamilyId INTEGER, PRIMARY KEY (machineId AUTOINCREMENT));");
                $this->sqlo();
                $this->vacias();
                $this->nuevas();
                $this->datamachine($machineID);
                $this->dataplantingtype($machineID);
                $this->dataproduct($machineID);
                $this->datarow($machineID);
                $this->dataoffset($machineID);
                $this->dataactuator($machineID);
                $this->datasensors($machineID);
                $this->dataproductsensor($machineID);//
                $this->dataproductsensorproduct($machineID);
                $this->dataactuatorsection($machineID);
                $this->dataactuatorrow($machineID);
                $this->dataactuatorsensors($machineID);
                $this->dataecus($machineID);
                $this->dataecusactuator($machineID);
                $this->dataactuatorecuoutputs($machineID);
                $this->datasensorecuinputs($machineID);

                //$this->probandoando();

                return response()->download(public_path('leaf.sqlite'));
                
            } catch (PDOException $e) {
                echo "pasa de largo";
            }
        }
            public function sqlo(){
            $consult = "CREATE TABLE IF NOT EXISTS rows (rowId INTEGER NOT NULL UNIQUE, rowNumber INTEGER NOT NULL, PRIMARY KEY (rowId AUTOINCREMENT)); ";        
            
            $consult1 = " 
                CREATE TABLE IF NOT EXISTS actuators (
                id INTEGER NOT NULL UNIQUE,
                machineId INTEGER NOT NULL,
                actuatorModelId INTEGER,
                name TEXT,
                actuatorType INTEGER NOT NULL,
                PRIMARY KEY (id AUTOINCREMENT),
                FOREIGN KEY(machineId) REFERENCES machineData('machineId') ON DELETE NO ACTION
            ); ";
    
            $consult2 = " CREATE TABLE IF NOT EXISTS ecus (ecuId INTEGER NOT NULL UNIQUE, name TEXT NOT NULL, nodeId INTEGER NOT NULL, address INTEGER NOT NULL, PRIMARY KEY(ecuId AUTOINCREMENT)); ";
                    
            $consult3 = " 
            CREATE TABLE IF NOT EXISTS ecusActuators (
                id INTEGER NOT NULL UNIQUE,
                ecuId INTEGER NOT NULL,
                actuatorId INTEGER NOT NULL,
                PRIMARY KEY(id AUTOINCREMENT),
                FOREIGN KEY(actuatorId) REFERENCES 'actuators'('id') ON DELETE NO ACTION,
                FOREIGN KEY(ecuId) REFERENCES 'ecus'('ecuId') ON DELETE NO ACTION
            );";
                    
            $consult4 = " CREATE TABLE IF NOT EXISTS actuatorsRows (id INTEGER NOT NULL UNIQUE, actuatorId INTEGER NOT NULL, rowId INTEGER NOT NULL, PRIMARY KEY(id AUTOINCREMENT), FOREIGN KEY(actuatorId) REFERENCES 'actuators'('id') ON DELETE NO ACTION, FOREIGN KEY(rowId) REFERENCES 'rows'('rowId') ON DELETE NO ACTION);";
                 
            $consult5 = " CREATE TABLE IF NOT EXISTS productSensors (id INTEGER NOT NULL UNIQUE, instanceId INTEGER NOT NULL, rowId INTEGER NOT NULL, isMuted INTEGER NOT NULL DEFAULT 0, version TEXT, reportIcs INTEGER NOT NULL DEFAULT 0, PRIMARY KEY(id AUTOINCREMENT), FOREIGN KEY(rowId) REFERENCES 'rows'('rowId') ON DELETE NO ACTION); ";
                  
            $consult6 = " CREATE TABLE IF NOT EXISTS plantingTypes (id INTEGER NOT NULL UNIQUE, machineId INTEGER NOT NULL, name TEXT NOT NULL, doubleLineConfig INTEGER NOT NULL DEFAULT 0, rowDistance REAL NOT NULL, isActive INTEGER NOT NULL DEFAULT 0, sowingModeType INTEGER NOT NULL, PRIMARY KEY(id AUTOINCREMENT), FOREIGN KEY(machineId) REFERENCES 'machineData'('machineId') ON DELETE NO ACTION);";
            
            $consult7 = " CREATE TABLE IF NOT EXISTS products (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, plantingTypeId INTEGER NOT NULL, name TEXT, sections INTEGER NOT NULL, actuatorsCombType INTEGER NOT NULL, enable TEXT NOT NULL, productType INTEGER NOT NULL, 'main' INTEGER NOT NULL DEFAULT 0, FOREIGN KEY('plantingTypeId') REFERENCES 'plantingTypes'('id') ON DELETE NO ACTION); ";
                    
            $consult8 = " CREATE TABLE IF NOT EXISTS actuatorSections ('id' INTEGER NOT NULL UNIQUE, 'productId' INTEGER NOT NULL, 'actuatorId' INTEGER NOT NULL, 'sectionNumber' INTEGER NOT NULL, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('productId') REFERENCES 'products'('id') ON DELETE NO ACTION, FOREIGN KEY('actuatorId') REFERENCES 'actuators'('id') ON DELETE NO ACTION);";
                    
            $consult9 = " CREATE TABLE IF NOT EXISTS productSensorsProducts ('id' INTEGER NOT NULL UNIQUE, 'sensorId' INTEGER NOT NULL, 'productId' INTEGER NOT NULL, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('productId') REFERENCES 'products'('id') ON DELETE NO ACTION, FOREIGN KEY('sensorId') REFERENCES 'productSensors'('id') ON DELETE NO ACTION); ";
                    
            $consult10 = " CREATE TABLE IF NOT EXISTS turbineTypes ('id' INTEGER NOT NULL UNIQUE, 'actuatorId' INTEGER NOT NULL, 'turbineType' INTEGER NOT NULL, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('actuatorId') REFERENCES 'actuators'('id') ON DELETE NO ACTION); ";
                    
            $consult11 = " CREATE TABLE IF NOT EXISTS sensors ('id' INTEGER NOT NULL UNIQUE, 'instanceId' INTEGER NOT NULL, 'isMuted' INTEGER NOT NULL DEFAULT 0, 'version' TEXT, 'isCan' INTEGER NOT NULL DEFAULT 0, 'sensorType' INTEGER NOT NULL DEFAULT 0, subtype INTEGER NOT NULL DEFAULT 0, PRIMARY KEY('id' AUTOINCREMENT));";
                    
            $consult12 = " CREATE TABLE IF NOT EXISTS actuatorsSensors ('id' INTEGER NOT NULL UNIQUE, 'actuatorId' INTEGER NOT NULL, 'sensorId' INTEGER NOT NULL, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('actuatorId') REFERENCES 'actuators'('id') ON DELETE NO ACTION, FOREIGN KEY('sensorId') REFERENCES 'sensors'('id') ON DELETE NO ACTION);";
           
            $consult13 = "CREATE TABLE IF NOT EXISTS sectionsRows ('id' INTEGER NOT NULL UNIQUE, 'productId' INTEGER NOT NULL, 'sectionNumber' INTEGER NOT NULL, rowId INTEGER, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('productId') REFERENCES 'products'('id') ON DELETE NO ACTION, FOREIGN KEY(rowId) REFERENCES 'rows'('rowId') ON DELETE NO ACTION);";

            try
            { 
                
                $this->DB->query($consult);
                $this->DB->query($consult1);
                $this->DB->query($consult2);
                $this->DB->query($consult3);
                $this->DB->query($consult4);
                $this->DB->query($consult5);
                $this->DB->query($consult6);
                $this->DB->query($consult7);
                $this->DB->query($consult8);
                $this->DB->query($consult9);
                $this->DB->query($consult10);
                $this->DB->query($consult11);
                $this->DB->query($consult12);
                $this->DB->query($consult13);
                
            }
            catch(PDOException $e)
            {
                echo "$consult";
              }
        } 
    
        public function vacias(){
                    
            /*== TABLAS VACIAS==*/
            
            $consult = " CREATE TABLE IF NOT EXISTS actuatorsEcuOutputs ('id' INTEGER NOT NULL UNIQUE, 'actuatorId' INTEGER NOT NULL, 'outputNumber' INTEGER NOT NULL, 'isInverted'	INTEGER NOT NULL DEFAULT 0, 'outputType' INTEGER NOT NULL DEFAULT 0, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('actuatorId') REFERENCES 'actuators'('id') ON DELETE NO ACTION); ";
                    
            $consult2 = " CREATE TABLE IF NOT EXISTS doseUnits ('id' INTEGER NOT NULL UNIQUE, 'unitName' TEXT NOT NULL, 'unitType' INTEGER NOT NULL, PRIMARY KEY('id' AUTOINCREMENT)); ";
                    
            $consult3 = " CREATE TABLE IF NOT EXISTS masks ('id' INTEGER NOT NULL UNIQUE, 'mask1' INTEGER, 'mask2' INTEGER, 'mask3' INTEGER, 'mask4' INTEGER, PRIMARY KEY('id' AUTOINCREMENT));";   
                    
            $consult4 = " CREATE TABLE IF NOT EXISTS masksActuators ('id' INTEGER NOT NULL UNIQUE, 'actuatorId' INTEGER NOT NULL, 'maskId' INTEGER NOT NULL, 'productId' INTEGER NOT NULL, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('maskId') REFERENCES 'masks'('id') ON DELETE CASCADE, FOREIGN KEY('actuatorId') REFERENCES 'actuators'('id') ON DELETE NO ACTION);";
                    
            $consult5 = " CREATE TABLE IF NOT EXISTS masksSections ('id' INTEGER NOT NULL UNIQUE, 'maskId' INTEGER NOT NULL, 'productId' INTEGER NOT NULL, 'sectionNumber' INTEGER NOT NULL, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('maskId') REFERENCES 'masks'('id') ON DELETE CASCADE);";
                    
            $consult6 = " CREATE TABLE IF NOT EXISTS motorsFactor ('id' INTEGER NOT NULL UNIQUE, 'plantingTypeId' INTEGER NOT NULL, 'productId' INTEGER NOT NULL, 'factor' NUMERIC NOT NULL, 'softCounts' INTEGER, 'userData' REAL NOT NULL, 'unitId' INTEGER NOT NULL, 'name' TEXT, 'isActive' INTEGER, PRIMARY KEY('id' AUTOINCREMENT), FOREIGN KEY('plantingTypeId') REFERENCES 'plantingTypes'('id') ON DELETE NO ACTION, FOREIGN KEY('productId') REFERENCES 'products'('id') ON DELETE NO ACTION);";   
                    
            $consult7 = " CREATE TABLE IF NOT EXISTS dbInfo ('id' INTEGER NOT NULL UNIQUE, 'mayor' INTEGER NOT NULL DEFAULT 1, 'minor' INTEGER NOT NULL DEFAULT 0, 'revision' INTEGER NOT NULL DEFAULT 6, PRIMARY KEY('id' AUTOINCREMENT)); ";
            
           try
            { 
                
                $this->DB->query($consult);
                $this->DB->query($consult2);
                $this->DB->query($consult3);
                $this->DB->query($consult4);
                $this->DB->query($consult5);
                $this->DB->query($consult6);
                $this->DB->query($consult7);
               
            }
            catch(PDOException $e)
            {
                echo "$consult";
            }
        }
    
        public function nuevas(){
                        
        /*==TABLAS NUEVAS==*/
    
        $consult = " CREATE TABLE IF NOT EXISTS rowsOffsets('id' INTEGER NOT NULL UNIQUE, 'rowId' INTEGER NOT NULL, 'offset' INTEGER NOT NULL, FOREIGN KEY('rowId') REFERENCES 'rows'('rowId') ON DELETE NO ACTION, PRIMARY KEY('id' AUTOINCREMENT));";
    
        $consult1 = " CREATE TABLE IF NOT EXISTS electroValveTypes ('id' INTEGER NOT NULL UNIQUE, 'actuatorId' INTEGER NOT NULL, 'electroValveType' INTEGER NOT NULL, FOREIGN KEY('actuatorId') REFERENCES 'actuators'('id') ON DELETE NO ACTION, PRIMARY KEY('id' AUTOINCREMENT));";
    
        $consult2 = " CREATE TABLE IF NOT EXISTS sensorsEcuInputs ('Id' INTEGER NOT NULL UNIQUE, 'ecuId' INTEGER NOT NULL, 'sensorId'	INTEGER NOT NULL, 'inputNumber'	INTEGER NOT NULL, 'isInverted'	INTEGER NOT NULL DEFAULT 0, 'inputType'	INTEGER NOT NULL DEFAULT 0, PRIMARY KEY('Id' AUTOINCREMENT));";
    
            try
            { 
                
                $this->DB->query($consult);
                $this->DB->query($consult1);
                $this->DB->query($consult2);
                //$this->DB->query($consult3);
            
            }
            catch(PDOException $e)
            {
                echo "$consult";
            }
        }
    
        /*-----ACA EMPIEZAN LOS INSERTS */
        
        public function datamachine($machineID){
    
            $model = MAchineData::where('machineId', $machineID)->first();
            $result = "INSERT INTO machineData (machineId, name, description, rowsQty, rowsFixedDistance, doubleLineConfig, machineFamilyId) VALUES ( 1, '$model->name', '$model->description', $model->rowsQty, $model->rowsFixedDistance, $model->doubleLineConfig, $model->machineFamilyId);";
            $result2 = "INSERT INTO dbInfo (id, mayor, minor, revision) VALUES (1, 1, 0, $model->version);";
            try{
                 $this->DB->query($result);
                 $this->DB->query($result2);
                }catch(PDOException $e){
                    echo "no sigue";
                }
        }

        public function dataplantingtype($machineID){
            $posts = DB::table('plantingtypes')->where('machineId', '=', $machineID)->count();

            $i = 1;

            for($i=1;$i <= $posts;$i++){
                $model2 = Plantingtypes::where('machineId', $machineID)->orderBy('ordercode', 'asc')->first();

                $result2 = "INSERT INTO plantingTypes (id, machineId, name, doubleLineConfig, rowDistance, isActive, sowingModeType) VALUES ( $i, 1, '$model2->name', $model2->doubleLineConfig, $model2->rowDistance, $model2->isActive, $model2->sowingModeType);";
                $this->DB->query($result2);
              
            }
              
        }

        public function dataproduct($machineID){

        //Cuantos tipos de siembre tiene la maquina
        $posts = DB::table('plantingtypes')->where('machineId', '=', $machineID)->count();
       
        //Cual es el primer numero de Id de tipo de siembra que usa
        $firstid = DB::table('plantingtypes')->where('machineId', '=', $machineID)->first('plantingtypeid');
        
        $i =  0 + $firstid->plantingtypeid;
        $cp = 1;
        $indice = 1;
        //Obtengo la cantidad de productos relacionamos por el tipo de siembra y la maquina
        $data = DB::table('products')
        ->join('plantingtypes','products.plantingtypeid', '=', 'plantingtypes.plantingtypeid')
        ->where('plantingTypes.machineId',$machineID)
        ->where('plantingTypes.plantingtypeid',$i)
        ->count();
        $queryfirstproductid = Products::where('plantingtypeid', $i)->first();
        $firstproductId      = 0 + $queryfirstproductid->productsId; // 55
        // Si tiene mas de un tipo de siembra
        if($posts > 1){
          

            if($data >= 2){
               
                for($p=1;$p<=$data;$p++){
                    $model = Products::where('productsId', $firstproductId)->first(); //`sections` `actuatorsCombType` `enable` `productType` `main`
                    $result = "INSERT INTO products (id, plantingTypeId, name, sections, actuatorsCombType, enable, productType , main) VALUES ( $cp, $indice, '$model->name', $model->sections, $model->actuatorsCombType, $model->enable, $model->productType, $model->main);";
        
                    $this->DB->query($result);
                    $cp ++;
                    $firstproductId++;
                }
                $i ++;
                $indice++;
            }

        }else{

            $model = Products::where('productsId', $firstproductId)->first(); //`sections` `actuatorsCombType` `enable` `productType` `main`
            for($x=1;$x<=$data;$x++){
                $result = "INSERT INTO products (id, plantingTypeId, name, sections, actuatorsCombType, enable, productType , main) VALUES ( $cp, 1, '$model->name', $model->sections, $model->actuatorsCombType, $model->enable, $model->productType, $model->main);";
    
                $this->DB->query($result);
                $cp ++;
                $firstproductId++;
            }

        }

        }
        public function datarow($machineID){
            //Cuantos surcos tiene la maquina
            $posts = DB::table('machine_data')->where('machineId', '=', $machineID)->first('rowsQty');
            
            $indice = 0 + $posts->rowsQty;

            //dd($indice);
            $i = 1;

            for($i=1;$i<=$indice;$i++){
                $result = "INSERT INTO rows (rowId, rowNumber) VALUES ( $i, $i);";
                $this->DB->query($result);
            }
        }

        public function dataoffset($machineID){
            //Cuantos surcos tiene la maquina
            $posts = DB::table('machine_data')->where('machineId', '=', $machineID)->first();

            $indice = 0 + $posts->rowsQty;
            $doble = 0 + $posts->doubleLineConfig;
            $machinedata = MachineData::where('machineId', '=', $machineID)->first();

            if($machinedata->onlyMonitor = 0){

                if($doble > 2){
                    $salio = 'aca';
                    dd($salio);
                    // Deberia si tiene offset pasarlo
                    // modificar tabla de offset para que lleve el machine id, si es par o no,  y el valor del offset
                    // es mas el if debe entrar si la tabla offset es true en la machine
                }else{
                    $queryoffset = Rows_offsets::where('machineId', $machineID)->first();
                    $description = strval($queryoffset->row_description);
                    
                    for($i=1;$i<=$indice;$i++){
                        $result = "INSERT INTO rowsOffsets  (id, rowId, offset) VALUES ( $i, $i, 0);";
                        $this->DB->query($result);
    
                        $porciones = explode(",", $description);
    
                        foreach($porciones as $offsets){
                            $result1 = "UPDATE rowsOffsets SET offset = $queryoffset->offset WHERE rowId = $offsets;";
                            //dd($result1);
                            $this->DB->query($result1);
                        }
                    }   
                }
            }else{
                for($i=1;$i<=$indice;$i++){
                    $result = "INSERT INTO rowsOffsets  (id, rowId, offset) VALUES ( $i, $i, 0);";
                    $this->DB->query($result);
                }
            }
        }
        
        public function dataactuator($machineID){
            $posts              = Actuators::where('machineId', '=', $machineID)->orderBy('actuatorsId', 'asc')->first();
            $index              = 0 + $posts->actuatorsId;
            $indexTurbine       = 1;
            $indexElectrovalves = 1;
            $data = Actuators::where('machineId', '=', $machineID)->count();
            //dd($data);
            for($i = 1; $i <= $data; $i++){
                $model = Actuators::where('machineId', $machineID)->where('actuatorsId', $index)->first();
                //dd($model);
                $result = "INSERT INTO actuators(id, machineId, actuatorModelId, name, actuatorType) VALUES ($i, 1, NULL, '$model->name', $model->actuatorType);";
                
                
                $this->DB->query($result);
                
                if($model->actuatorType == 3){ 
                        $result1 = "INSERT INTO turbineTypes(id, actuatorId, turbineType ) VALUES ($indexTurbine, $i, $model->subtype);";
                        $this->DB->query($result1);

                        $indexTurbine++;
                }
                if($model->actuatorType == 4){
                        $result1 = "INSERT INTO electroValveTypes (id, actuatorId, electroValveType) VALUES ($indexElectrovalves, $i, $model->subtype);";
                        $this->DB->query($result1);

                        $indexElectrovalves++;
                }
                
                $index++;
            }
        }
        
        public function datasensors($machineID){
            $machine = MachineData::where('machineId', $machineID)->first();
            $monitor = false;

            if($machine->onlyMonitor == 1){
                $monitor = true;
            }
            //SENSORS  `sensorid` `subtype``machineId` `sensorslist_Id`
            $posts = Sensors::where('machineId', '=', $machineID)->orderByDesc('sensorid')->first();
            $countposts = Sensors::where('machineId', '=', $machineID)->count();
            //SENSORS LIST `sensorslist_Id` `ordercode``name``subtype`
            $index = 1 + $posts->sensorid - $countposts;
            $instance = 0;
            $data = Sensors::where('machineId', $machineID)->count();
            

            
            for($i = 1; $i <= $data; $i++){
                $datajo = DB::table('sensors')
                ->join('sensors_list','sensors_list.sensorslist_Id', '=', 'sensors.sensorslist_Id')
                ->where('sensors.machineId',$machineID)
                ->where('sensors.sensorid',$index)
                ->first();
                
                // 'id', 'instanceId', 'isMuted', 'version' , 'isCan' , 'sensorType'  subtype 
                if($monitor){
                    
                    $result = "INSERT INTO sensors(id, instanceId, isMuted, version, isCan, sensorType, subtype) VALUES ($i, $instance, 0, 0.0, 1, $datajo->ordercode, $datajo->subtype);";
                    
                    $this->DB->query($result);
                    $index++;
                    $instance++;
                }else{
                    $result = "INSERT INTO sensors(id, instanceId, isMuted, version, isCan, sensorType, subtype) VALUES ($i, $instance, 0, 0.0, 0, $datajo->ordercode, $datajo->subtype);";
                    
                    $this->DB->query($result);
                    $index++;
                    $instance++;
                }

            }
        }
       
        public function dataproductsensor($machineID){
            // global saco prosenpro_firstId prosenpro_lastId
            $firstprosen = Global_Machinedata::where('machineId', $machineID)->first('prosen_firstId');
            
            $lastprosen  = Global_Machinedata::where('machineId', $machineID)->first('prosen_lastId');
            
            $prosenfirst = $firstprosen->prosen_firstId;
            $prosenlast  = $lastprosen->prosen_lastId;

            $dif = $prosenlast - $prosenfirst;

            $instance = 0;
            
            for($i = 1; $i <= $dif; $i++){
                $model = Products_Sensors::where('productSensorsId', $prosenfirst)->first();
                //id , instanceId, rowId , isMuted, version , reportIcs
                $result = "INSERT INTO productSensors(id, instanceId, rowId , isMuted, version , reportIcs) VALUES ($i, $instance, $model->rowId, $model->isMuted, '$model->version', $model->reportIcs);";
                
                $this->DB->query($result);

                $prosenfirst++;
                $instance++;
            }
        }
        public function dataproductsensorproduct($machineID){
            // global saco prosenpro_firstId prosenpro_lastId
            $firstprosenpro     = Global_Machinedata::where('machineId', $machineID)->first('prosenpro_firstId');
            
            $lastprosenpro      = Global_Machinedata::where('machineId', $machineID)->first('prosenpro_lastId');

            $firstprosenproId   = 0 + $firstprosenpro->prosenpro_firstId;

            $prosenprofirst     = $firstprosenpro->prosenpro_firstId;
            $prosenprolast      = $lastprosenpro->prosenpro_lastId;

            $dif                = $prosenprolast - $prosenprofirst;
           
            $contadorprod       = 0;
            $firstproductId     = 0;
            $indexprod2         = 0;
            $secondproductId    = 0;
            $indexprod3         = 0;
            $threeproductId     = 0;
            $indexprod4         = 0;
            $fourproductId      = 0;
            $indexprod5         = 0;
            $fiveproductId      = 0;
            $indexprod6         = 0;
            $sixproductId       = 0;
            $indexprod7         = 0;
            $sevenproductId     = 0;
            $indexprod8         = 0;
            $eightproductId     = 0;
            $indexprod9         = 0;
            $nineproductId      = 0;
            $indexprod10        = 0;
            $tenproductId       = 0;
            $indexprod11        = 0;
            $elevenproductId    = 0;
            $indexprod12        = 0;
            $twelveproductId    = 0;
            $indexprod13        = 0;
            $thirteenproductId  = 0;
            $indexprod14        = 0;
            $fourteenproductId  = 0;
            $indexprod15        = 0;
            $fiveteenproductId  = 0;
            $indexprod16        = 0;
            $sixteenproductId   = 0;
            $indexprod17        = 0;
            $seventeenproductId = 0;
            $indexprod18        = 0;
            $eighteenproductId  = 0;

            //Busco los Ids de los productos
            for($p = 1; $p <= $dif; $p++){
                $querymodel      = Product_Sensors_Products::where('productSensorProductsId', $firstprosenproId)->first();
                if($firstprosenproId == $prosenprofirst){
                    $firstproductId = $firstproductId + $querymodel->productId;
                    $indexprod2     = 1 + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod2){
                    $secondproductId = $secondproductId + $querymodel->productId;
                    $indexprod3     = 1 + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod3){
                    $threeproductId = $threeproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod4){
                    $fourproductId = $fourproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod5){
                    $fiveproductId = $fiveproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod6){
                    $sixproductId = $sixproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod7){
                    $sevenproductId = $sevenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod8){
                    $eightproductId = $eightproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod9){
                    $nineproductId = $nineproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod10){
                    $tenproductId = $tenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod11){
                    $elevenproductId = $elevenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod12){
                    $twelveproductId = $twelveproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod13){
                    $thirteenproductId = $thirteenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod14){
                    $fourteenproductId = $fourteenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod15){
                    $fiveteenproductId = $fiveteenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod16){
                    $sixteenproductId = $sixteenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod17){
                    $seventeenproductId = $seventeenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
                if($querymodel->productId == $indexprod18){
                    $eighteenproductId = $eighteenproductId + $querymodel->productId;
                    $firstprosenproId++;
                    $contadorprod++;
                }
            }

            
            for($i = 1; $i <= $dif; $i++){
                $model      = Product_Sensors_Products::where('productSensorProductsId', $prosenprofirst)->first();
 
                if($contadorprod>=2){
                    if($model->productId == $firstproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 1);";
                       
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    
                    if($model->productId == $secondproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 2);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $threeproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 3);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $fourproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 4);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $fiveproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 5);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $sixproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 6);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $sevenproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 7);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $eightproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 8);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $nineproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 9);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $tenproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 10);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $elevenproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 11);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $twelveproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 12);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $thirteenproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 13);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $fourteenproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 14);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $fiveteenproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 15);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $sixteenproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 16);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    if($model->productId == $seventeenproductId){

                        $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 17);";
                        
                        $this->DB->query($result);
        
                        $prosenprofirst++;
                    }
                    //SI NO ANDA ASI PROBAR CAMBIAR $i del sensorId por $model->sensorId
                }else{
                    $result = "INSERT INTO productSensorsProducts(id, sensorId, productId) VALUES ($i, $i, 1);";
                    
                    $this->DB->query($result);
    
                    $prosenprofirst++;
                }
            }
        }

        public function dataactuatorsection($machineID){
            $queryActuators     = Actuators::where('machineId', $machineID)->orderBy('actuatorsId', 'asc')->first();
            $queryActuatorCount = Actuators::where('machineId', $machineID)->count();
            $firstAcuatorId     = 0 + $queryActuators->actuatorsId;
            $indice = 1;
            //dd($queryActuators);
            
            for($i=1; $i <= $queryActuatorCount; $i++){
                $model  = Actuators_Sections::where('actuatorsId',$firstAcuatorId)->first();
                $actuatorType       = Actuators::where('actuatorsId', $firstAcuatorId)->first();
                if($actuatorType->actuatorType != 3 && $actuatorType->actuatorType != 4){
                    $g = 1;
                    //dd($g);
               
                $result = "INSERT INTO actuatorSections(id, productId, actuatorId, sectionNumber) VALUES ($i, $model->productsId, $indice, $model->sectionNumber);";
                
                $this->DB->query($result);

                $firstAcuatorId++;
                $indice ++;
                }
            }
        }

        public function dataactuatorrow($machineID){
            $queryActuators     = Actuators::where('machineId', $machineID)->where('actuatorType','!=', 3)->orderBy('actuatorsId', 'asc')->first();
            $queryActuatorCount = Actuators::where('machineId', $machineID)->where('actuatorType','!=', 3)->count();
            $firstAcuatorId     = 0 + $queryActuators->actuatorsId;
            $indiceactuador= 1;
            $indice = 1;
            //dd($indice);
            //$model = Actuators_Rows::where('actuatorId',$firstAcuatorId)->orderBy('actuatorsrowsId', 'asc')->first();
            for($i=1;$i<=$queryActuatorCount;$i++){
                $modelcount = Actuators_Rows::where('actuatorId',$firstAcuatorId)->count();
                if($modelcount>=1){
                    for($j=1;$j<=$modelcount;$j++){
                        $query = Actuators_Rows::where('actuatorId',$firstAcuatorId)->where('rowId',$indice)->orderBy('actuatorsrowsId', 'asc')->first();
                        if($query){
                            $result = "INSERT INTO actuatorsRows(id , actuatorId , rowId) VALUES ($indice, $indiceactuador, $query->rowId);"; 
                            $this->DB->query($result);
                            $indice = $indice + 1;
                        }
                    }
                    $indiceactuador++;
                }
                $firstAcuatorId++;
            }

        }

        public function dataactuatorsensors($machineID){
            $machineVersion = MachineData::where('machineId',$machineID)->first();
            $version        = 0 + $machineVersion->version;
           
            if($version >= 7){
                if($machineVersion->onlyMonitor == 0 && $machineVersion->monitor_model == 1){
                    $queryactuatorcount = Actuators::where('machineId', $machineID)->count();
                    
                    $querysensors       = Sensors::where('machineId',$machineID)->orderBy('sensorid', 'asc')->first();
                    
                    $querysensorscount  = Sensors::where('machineId',$machineID)->count();
                    $firstsensorid      = 0 + $querysensors->sensorid;
                    $indice             = 1;
                    
                    if($querysensorscount >= 1){                        
                        $datajoin = DB::table('actuators_sensors')
                        ->join('sensors','sensors.sensorslist_Id', '=', 'actuators_sensors.actuatorsSensorsId')
                        ->where('sensors.sensorid',$firstsensorid)
                        ->first();
                
                        for($i=1;$i<=$querysensorscount;$i++){
                            if($datajoin->sensorslist_Id == 3){
                                $result = "INSERT INTO actuatorsSensors(id, actuatorId, sensorId) VALUES ($indice, $queryactuatorcount, $indice);";
                                $this->DB->query($result);
                                $indice++;
                                $firstsensorid++;
                            }
                            if($datajoin->sensorslist_Id == 4){
                                $result = "INSERT INTO actuatorsSensors(id, actuatorId, sensorId) VALUES ($indice, $queryactuatorcount, $indice);";
                               
                                $this->DB->query($result);
                                $indice++;
                                $firstsensorid++;
                            }
                        }
                    }
                }
            }
        }

        public function dataecus($machineID){
            $ecu = Ecus::where('machineId', $machineID)->orderBy('ecuId', 'asc')->first();
            $queryecusCount = Ecus::where('machineId', $machineID)->count();
            $ecuFirstId     = 0 + $ecu->ecuId;
            //dd($ecuFirstId);
            for($i=1;$i<=$queryecusCount;$i++){
                $ecus = Ecus::where('machineId', $machineID)->where('ecuId',$ecuFirstId)->first();
                if($queryecusCount>=1){
                    $result = "INSERT INTO ecus(ecuId, name, nodeId, address) VALUES ($i, '$ecus->name', $ecus->adress, $ecus->adress);";
                    $this->DB->query($result);
    
                    $ecuFirstId ++;
                }
            }
        }

	    public function dataecusactuator($machineID){
            $ecu = Ecus::where('machineId', $machineID)->orderBy('ecuId', 'asc')->first();
            $queryecusCount = Ecus::where('machineId', $machineID)->count();
            $ecuFirstId     = 0 + $ecu->ecuId;
            
            $indice         = 1;
            $indiceactuador = 1;
            $ecuId          = 1;
            //Ecus_Actuators::where('ecuId',$ecuFirstId)->orderBy('ecusActuatorsId', 'asc')->first();
            if($queryecusCount>=1){
                //dd($modelcount);
                for($e=1;$e<=$queryecusCount;$e++){
                    $model      = Ecus_Actuators::where('ecuId',$ecuFirstId)->orderBy('ecusActuatorsId', 'asc')->first();
                    $modelcount = Ecus_Actuators::where('ecuId',$ecuFirstId)->count();
                    if($model){
                        for($i=1;$i<=$modelcount;$i++){
                            $result = "INSERT INTO ecusActuators(id, ecuId, actuatorId) VALUES ($indice, $ecuId, $indiceactuador);";
                            $this->DB->query($result);
                            $indice++;
                            $indiceactuador++;
                        }
                        $ecuId++;
                        $ecuFirstId++;
                    }else{
                        $ecuFirstId++;
                    }
                }
            }
            //$result = "INSERT INTO ecusActuators(id, ecuId, actuatorId) VALUES ($indice, $i, $indice);";
        }

        public function dataactuatorecuoutputs($machineID){
            $queryfirstecuoput = actuators_ecuoutputs::where('machineId', $machineID)->first();
            $firstecuoutput    = 0 + $queryfirstecuoput->actuatorId;

            $querycount         = actuators_ecuoutputs::where('machineId', $machineID)->count();
            $indice             = 1;
            $model = actuators_ecuoutputs::where('machineId', $machineID)->where('actuatorId',$firstecuoutput)->first();//`outputnumber` `isinverted``outputtype`
            for($i=1;$i<=$querycount;$i++){

                $result = "INSERT INTO actuatorsEcuOutputs(id, actuatorId , outputNumber, isInverted, outputType) VALUES ($i, $indice, $model->outputnumber, $model->isinverted,$model->outputtype);";
                $this->DB->query($result);

                $firstecuoutput++;
                $indice++;
            }
        }

        public function datasensorecuinputs($machineID){
            $queryfirstseninput = Sensors_ecuinputs::where('machineId', $machineID)->orderBy('sensors_ecuinputsId', 'asc')->first();
            $firstseninput      = 0 + $queryfirstseninput->ecuId; //62
            $firstId            = 0 +  $queryfirstseninput->sensors_ecuinputsId;
            $totalcount         = Sensors_ecuinputs::where('machineId', $machineID)->count(); //2
            
            $indice             = 1;
            $indicesensor       = 1;
            $indiceecu          = 1;

            for($s=1;$s <= $totalcount;$s++){
                $countsenecuinput   = Sensors_ecuinputs::where('machineId', $machineID)->where('ecuId', $firstseninput)->count(); //2
                
                if($countsenecuinput >= 1){
                    
                    $model          =  Sensors_ecuinputs::where('machineId', $machineID)->where('ecuId', $firstseninput)->where('sensors_ecuinputsId', $firstId)->first();
                    //dd($model);
                    for($i=1;$i<=$countsenecuinput;$i++){
    
                        $result = "INSERT INTO sensorsEcuInputs(Id, ecuId, sensorId, inputNumber, isInverted, inputType) VALUES ($indice, $indiceecu, $indicesensor, $model->inputnumber,$model->isinverted,$model->inputtype);";
                        $this->DB->query($result);
    
                        $indice++;
                        $indicesensor++;
                        $firstId++;
                    }
                    $firstseninput++;
                    $indiceecu++;
                }
            }

        }
        

}
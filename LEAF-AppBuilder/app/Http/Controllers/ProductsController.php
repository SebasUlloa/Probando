<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Products_Traffic;
use App\Models\Product_list;
use App\Models\MachineData;
use Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
  
  
    public function index()
    {

       $products = Product_list::all();

        return view('products.products')->with('products', $products);
   }

   public function indexmonitor()
   {

        //$stuff_types = DB::table('product_list')->get();
        $stuff_types = Product_list::all();

        return view('products.solo-monitor.productsmonitor')->with('stuff_types', $stuff_types);
       
   }

  
    public function create(Request $request)
    {
       
    }

    public function createProfull(Request $request)
    {
        $machineID = $this->lastId();


        $product1 = $request->input('product1');
        $product2 = $request->input('product2');
        $product3 = $request->input('product3');
        $product4 = $request->input('product4');
        //dd($product1, $product2, $product3, $product4);

        $getlastId = DB::table('products__traffic')->orderByDesc('productstrafficId')->first('productstrafficId');
        
        if($getlastId){
            $lastId = $getlastId->productstrafficId + 1;
        }else{
            $lastId = 1;
        }           //productlistId	 name producttype	

        if($product1 != "NULL"){
            $product_info = DB::table('product_lists')->where('productlistId', 1)->first();
            $order = 0 + $product_info->producttype;
            DB::table('products__traffic')->insert([
                'productstrafficId' => $lastId,
                'ordercode' => $order,
                'name' => $product_info->name,
                'machineId' => $machineID,
                'updated_at' => now(),
                'created_at' => now()
                ]);
            $lastId ++;
        }

        if($product2 != "NULL"){
            $product_info = DB::table('product_lists')->where('productlistId', 2)->first();
            $order = $product_info->producttype;
            DB::table('products__traffic')->insert([
                'productstrafficId' => $lastId,
                'ordercode' => $order,
                'name' => $product_info->name,
                'machineId' => $machineID,
                'updated_at' => now(),
                'created_at' => now()
                ]);
            $lastId ++;
        }

        if($product3){
            $product_info = DB::table('product_lists')->where('productlistId', 3)->first();
            $order = $product_info->producttype;
            DB::table('products__traffic')->insert([
                'productstrafficId' => $lastId,
                'ordercode' => $order,
                'name' => $product_info->name,
                'machineId' => $machineID,
                'updated_at' => now(),
                'created_at' => now()
                ]);
            $lastId ++;
        }

        if($product4){
            $product_info = DB::table('product_lists')->where('productlistId', 4)->first();
           
            DB::table('products__traffic')->insert([
                'productstrafficId' => $lastId,
                'ordercode' => $product_info->producttype,
                'name' => $product_info->name,
                'machineId' => $machineID,
                'updated_at' => now(),
                'created_at' => now()
                ]);
            $lastId ++;
        }
       
            $machine = MachineData::where('machineId', $machineID)->first() ;
        
            $r = $machine->rowsQty;
            $rows = array();

            for($i=1; $i <= $r ; $i++){

                $rows[$i]= $i;
            
            }
            return redirect('/crucianelli/sensorsline')->with('rows', $rows);
    }

    public function createProdMon(Request $request){
        $machineID = $this->lastId();


        $product1 = $request->input('product1');
        $product2 = $request->input('product2');
        $product3 = $request->input('product3');
        $product4 = $request->input('product4');
        
        //dd($product1, $product2, $product3, $product4);

        $getlastId = DB::table('products__traffic')->orderByDesc('productstrafficId')->first('productstrafficId');
        
        if($getlastId){
            $lastId = $getlastId->productstrafficId + 1;
        }else{
            $lastId = 1;
        }           //productlistId	 name producttype	

        if($product1 != "NULL"){
            $product_info = DB::table('product_lists')->where('productlistId', 1)->first();
            $order = 0 + $product_info->producttype;
            DB::table('products__traffic')->insert([
                'productstrafficId' => $lastId,
                'ordercode' => $order,
                'name' => $product_info->name,
                'machineId' => $machineID,
                'updated_at' => now(),
                'created_at' => now()
                ]);
            $lastId ++;
        }

        if($product2 != "NULL"){
            $product_info = DB::table('product_lists')->where('productlistId', 2)->first();
            $order = $product_info->producttype;
            DB::table('products__traffic')->insert([
                'productstrafficId' => $lastId,
                'ordercode' => $order,
                'name' => $product_info->name,
                'machineId' => $machineID,
                'updated_at' => now(),
                'created_at' => now()
                ]);
            $lastId ++;
        }

        if($product3 != "NULL"){
            $product_info = DB::table('product_lists')->where('productlistId', 3)->first();
            $order = $product_info->producttype;
            DB::table('products__traffic')->insert([
                'productstrafficId' => $lastId,
                'ordercode' => $order,
                'name' => $product_info->name,
                'machineId' => $machineID,
                'updated_at' => now(),
                'created_at' => now()
                ]);
            $lastId ++;
        }

        if($product4 != "NULL"){
            $product_info = DB::table('product_lists')->where('productlistId', 4)->first();
           
            DB::table('products__traffic')->insert([
                'productstrafficId' => $lastId,
                'ordercode' => $product_info->producttype,
                'name' => $product_info->name,
                'machineId' => $machineID,
                'updated_at' => now(),
                'created_at' => now()
                ]);
            $lastId ++;
        }
       
            $machine = MachineData::where('machineId', $machineID)->first() ;
        
            $r = $machine->rowsQty;
            $rows = array();

            for($i=1; $i <= $r ; $i++){

                $rows[$i]= $i;
            
            }
        return view('sensors.solo-monitor.sensorslineamonitor')->with('rows', $rows);
    }
    public function store(){

    }
  
    public function edit($machineID)
    {
        $machine = MachineData::find($machineID);
        return view('products.edit')->with('products', $machineID);
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }

    public function lastId(){
        $machine = MachineData::select('machineId')->orderByDesc('machineId')->first();
        
        $lastId = 0 + $machine->machineId;
        
        return $lastId; // Asi anda la vista     
    }
}

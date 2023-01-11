<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MachineData;

class ErcaController extends Controller
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
        // Aca al agregar use app models crucianelli...podemos usar para traer todos los registros
       $erca = MachineData::all();
        return view('erca.index')->with('erca', $erca); // aca a la vista le pedimos que nos traiga en la vista todos los registro de la variable crucianelli
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('erca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $erca = new MachineData();

        $erca->machineID = $request->get('machineID');
        $erca->name  = $request->get('name');
        $erca->description  = $request->get('description');
        $erca->rowsQty = $request->get('rowsQty');
        $erca->rowsFixedDistance = $request->get('rowsFixedDistance');
        $erca->doubleLineConfig = $request->get('doubleLineConfig');
        $erca->machineFamilyId = $request->get('machineFamilyId');

        $erca->save();

        return redirect('/erca');
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
        $erca = MachineData::find($machineID);
        return view('erca.edit')->with('erca', $erca);
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
        $erca = MAchineData::find($machineID);

        $erca->machineID = $request->get('machineID');
        $erca->name  = $request->get('name ');
        $erca->description  = $request->get('description ');
        $erca->rowsQty = $request->get('rowsQty');
        $erca->rowsFixedDistance = $request->get('rowsFixedDistance');
        $erca->doubleLineConfig = $request->get('doubleLineConfig');
        $erca->machineFamilyId = $request->get('machineFamilyId');

        $erca->save();

        return redirect('/erca');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($machineID)
    {
        $erca = MAchineData::find($machineID);
        $erca->delete();

        return redirect('/erca');
    }
}

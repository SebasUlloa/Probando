@extends('adminlte::page')

@section('title', 'CREAR NUEVA MAQUINA')

@section('content_header')
    <h2>CREAR REGISTROS</h2>
@stop

@section('content')

<div class="btn-group">
    <a href="createmonitor" class="btn btn-success" aria-current="page">Machine Data</a>
    <a href="{{ route('productmonitor') }}" class="btn btn-success">Products</a>
    <a href="{{ route('sensorslineamonitor') }}" class="btn btn-success">Sensores por Linea</a>
    <a href="{{ route('actuatorsmonitor') }}" class="btn btn-success">Actuadores</a>
    <a href="{{ route('sensorsmonitor') }}" class="btn btn-success">Sensores</a>
    <a href="{{ route('plantingtypesmonitor') }}" class="btn btn-success">Tipos de siembra</a>   
</div>

<h1 class="mt-3">Datos Maquina Solo Monitor</h1>

<form action="/crucianelli" method="POST">
    @csrf

    <div class="mb-3">
        <label form="" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
        <div class="col-sm-8">
        <input id="name" name="name" type="text" class="form-control form-control-sm" tabindex="2">
        </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-2 col-form-label col-form-label-sm">Descripcion</label>
        <div class="col-sm-8">
        <input id="description" name="description" type="text" class="form-control form-control-sm" tabindex="3">
        </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-2 col-form-label col-form-label-sm">Cant. de surcos</label>
        <div class="col-sm-8">
        <input id="rowsQty" name="rowsQty" type="number" class="form-control form-control-sm" tabindex="4">
        </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Distancia entre surcos(en metros)</label>
        <div class="col-sm-8">
        <input id="rowsFixedDistance" name="rowsFixedDistance" type="number" step="any" value="0.0" class="form-control form-control-sm" tabindex="5">
        </div>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="solo-monitor" name="solo-monitor">
        <label class="form-check-label" for="solo-monitor">Solo monitor</label>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Version</label><br/>
        <select class="form-select-sm mb-3" aria-label=".form-select-lg example" id="version" name="version">
        <option value="NULL">Select..</option>
            @foreach($version as $version)  
                <option value="{{ $version->versionNum }}">{{ $version->versionNum}}</option>
            @endforeach 
        </select>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Modelo</label><br/>
        <select class="form-select-sm mb-3" aria-label=".form-select-lg example" id="machine-model" name="machine-model">
        <option value="NULL">Select..</option>
        @foreach($category as $category)
                <option value="{{ $category->machinecompanyId}}">{{ $category->model}}</option>
        @endforeach     
        </select>
    </div>
    <div class="mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="doubleLineConfig" name="doubleLineConfig" >
            <label class="form-check-label" for="doubleLineConfig">Doble Linea</label>
        </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Modelo Monitor</label><br/>
        <select class="form-select-sm mb-3" aria-label=".form-select-lg example" id="monitor-model" name="monitor-model">
        <option>Seleccion Modelo..</option>       
                <option value="0">MAP7-PRO</option>
                <option value="1">ORIZON</option>
        </select>
    </div>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('productmonitor') }}" class="btn btn-primary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="9">Siguiente</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@section('js')
@stop

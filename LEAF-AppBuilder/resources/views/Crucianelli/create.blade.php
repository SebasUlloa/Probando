@extends('adminlte::page')

@section('title', 'CREAR NUEVA MAQUINA')

@section('content_header')
    <h2>CREAR REGISTROS</h2>
@stop

@section('content')

<div class="btn-group">
  <a href="{{ route('createmachine')}}" class="btn btn-success active">Machine Data</a>
  <a href="{{ route('products')}}" class="btn btn-success">Products</a>
  <a href="{{ route('sensorsrows')}}" class="btn btn-success">Sensores por Linea</a>
  <a href="{{ route('rowsoffset')}}" class="btn btn-success">Desfasajes de Lineas</a>
  <a href="{{ route('actuators')}}" class="btn btn-success">Actuadores</a>
  <a href="{{ route('ecus')}}" class="btn btn-success">Ecus</a>
  <a href="{{ route('configs')}}" class="btn btn-success">Inputs/Outputs Configs</a>
  <a href="{{ route('plantingtypes')}}" class="btn btn-success">Tipos de siembra</a>
</div>

<h1 class="mt-3">Datos Maquina</h1>

<form action="/crucianelli" method="POST">
    @csrf
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="solo-monitor" name="solo-monitor">
        <label class="form-check-label" for="solo-monitor">Solo monitor</label>
    </div>
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
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Version</label>
            <div class="radio">
            @foreach($version as $version)  
                <input class="form-check-input" type="radio" name="version" id="version{{ $version->versionNum}}" value="{{ $version->versionNum}}">
                <label class="form-check-label" for="version{{ $version->versionNum}}">
                    {{ $version->versionNum}}
                </label>
            @endforeach 
            </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Modelo</label><br/>
        <div class="radio">
            @foreach($category as $category)
            <input class="form-check-input" type="radio" name="machine-model" id="machine-model{{$category->machinecompanyId}}" value="{{$category->machinecompanyId}}">
            <label class="form-check-label" for="machine-model{{$category->machinecompanyId}}">
                {{$category->model}}
            </label>
            @endforeach     
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="doubleLineConfig" name="doubleLineConfig" >
            <label class="form-check-label" for="doubleLineConfig">Doble Linea</label>
        </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Modelo Monitor</label>
        <div class="radio">
            <input class="form-check-input" type="radio" name="monitor-model" id="monitor-model1" value="0">
            <label class="form-check-label" for="monitor-model1">
                MAP7-PRO
            </label>
            <input class="form-check-input" type="radio" name="monitor-model" id="monitor-model2" value="1">
            <label class="form-check-label" for="monitor-model2">
                ORIZON
            </label>
        </div>
    </div>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('products') }}" class="btn btn-primary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="9">Siguiente</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@section('js')
@stop
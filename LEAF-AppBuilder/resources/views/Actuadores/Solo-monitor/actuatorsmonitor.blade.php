@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="btn-group">
<a href="createmonitor" class="btn btn-success" aria-current="page">Machine Data</a>
    <a href="{{ route('productmonitor') }}" class="btn btn-success">Products</a>
    <a href="{{ route('sensorslineamonitor') }}" class="btn btn-success">Sensores por Linea</a>
    <a href="{{ route('actuatorsmonitor') }}" class="btn btn-success">Actuadores</a>
    <a href="{{ route('plantingtypesmonitor') }}" class="btn btn-success">Tipos de siembra</a>   
</div>
<h1 class="mt-3">Actuadores</h1>
<hr/>
<form action="{{ route('hasactuator') }}" method="post">
    @csrf
            <div class="mb-3">
    <div class="col-sm-8">
    <br/>      
            <h6>Seleccione cantidad por actuador</h6>
    <br/>
        <div class="select">
            <label form="" class="col-sm-2 col-form-label col-form-label-sm">EMBRAGUES</label> 
            <input name="E" type="number" class="seleccion" tabindex="0">
        </div>
        <div class="select">
            <label form="" class="col-sm-2 col-form-label col-form-label-sm">EMBRAGUES DE ACOPLE</label> 
            <input name="EA" type="number" class="seleccion" tabindex="5">
        </div>
        <div class="select">
            <label form="" class="col-sm-2 col-form-label col-form-label-sm">MOTORES</label> 
            <input name="M" type="number" class="seleccion" tabindex="1">
        </div>
        <div class="select">
            <label form="" class="col-sm-2 col-form-label col-form-label-sm">CAJA ELECTRONICA</label> 
            <input name="CE" type="number" class="seleccion" tabindex="2">
        </div>
        <div class="select">
            <label form="" class="col-sm-2 col-form-label col-form-label-sm">TURBINA</label> 
            <input name="T" type="number" class="seleccion" tabindex="3">
        </div>
        <div class="select">
            <label form="" class="col-sm-2 col-form-label col-form-label-sm">ELECTROVALVULA</label> 
            <input name="EV" type="number" class="seleccion" tabindex="4">
        </div>
    </div>
 
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('hasactuator') }}" class="btn btn-primary">Siguiente</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
@stop
@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="btn-group">
  <a href="{{ route('createmachine')}}" class="btn btn-success">Machine Data</a>
  <a href="{{ route('products')}}" class="btn btn-success">Products</a>
  <a href="{{ route('sensorsrows')}}" class="btn btn-success">Sensores por Linea</a>
  <a href="{{ route('rowsoffset')}}" class="btn btn-success">Desfasajes de Lineas</a>
  <a href="{{ route('actuators')}}" class="btn btn-success active">Actuadores</a>
  <a href="{{ route('ecus')}}" class="btn btn-success">Ecus</a>
  <a href="{{ route('configs')}}" class="btn btn-success">Inputs/Outputs Configs</a>
  <a href="{{ route('plantingtypes')}}" class="btn btn-success">Tipos de siembra</a>
</div>
<h1 class="mt-3">Config Actuators Machine</h1>
<hr/>
<form action="{{ route('hasFullactuators')}}" method="post">
    @csrf
            <div class="mb-3">
    <div class="col-sm-8">
    <br/>      
            <h6>Seleccione cantidad por actuador</h6>
    <br/>
        @foreach($actuators as $actuator)
        <div class="select">
            <label form="" class="col-sm-2 col-form-label col-form-label-sm">{{$actuator->name}}</label> 
            <input name="{{$actuator->initials}}" type="number" class="seleccion" tabindex="0">
        </div>
        @endforeach
    </div>
 
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('hasFullactuators')}}" class="btn btn-primary">Siguiente</button>
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
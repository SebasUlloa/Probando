@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="btn-group">
  <a href="{{ route('createmachine')}}" class="btn btn-success active">Machine Data</a>
  <a href="{{ route('products')}}" class="btn btn-success">Products</a>
  <a href="{{ route('sensorsrows')}}" class="btn btn-success">Sensores por Linea</a>
  <a href="{{ route('rowsoffset')}}" class="btn btn-success">Desfasajes de Lineas</a>
  <a href="{{ route('actuators')}}" class="btn btn-success">Actuadores</a>
  <a href="{{ route('ecus')}}" class="btn btn-success">Ecus</a>
  <a href="{{ route('configs')}}" class="btn btn-success  active">Inputs/Outputs Configs</a>
  <a href="{{ route('plantingtypes')}}" class="btn btn-success">Tipos de siembra</a>
</div>
<h1 class="mt-3">Configuracion de defasajes por linea</h1>
<hr/>
<form action="{{ route('createoffset')}}" method="POST">
    @csrf
    <h6>Selecciones los niveles de defasajes</h6>
    <div class="select" width="20">
            <label class="form-check-label" for="linea">Cant. de Niveles</label>
            <select class="seleccion mb-3">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
    </div>
    <br/>
    <h6>Elija las lineas a aplicar el defasaje</h6>
    <div class="mb-3">
        <label form="" class="col-form-label col-form-label mb-3">Nivel 1</label>
        <!--BARRA DE RANGO-->
        <div class="rango">
            <label for="customRange2" class="form-label">Medida del defasaje</label>
            <input type="range" class="slider" min="0.00" max="2.00" step="0.01" id="range" name="range">
            <p>Value: <span id="value"></span></p>
        </div>  
        <!--BOTONES PARIDAD-->
        <label for="customRange2" class="form-label">Seleccion rango de lineas para ha aplicar el defasaje</label>
        <a href="#" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4">Seleccionar Pares</a>
        <a href="#" class="btn btn-warning mb-2 ml-2 mr-2 mt-4 mb-4">Seleccionar Impares</a>
        <!--INPUT PARA ESCRIBIR EL RANGO A MANO-->
        <div class="col-sm-8">
        <input id="rowsdescription" name="rowsdescription" type="text" class="skere">
        </div>
    </div>
    <hr/>
    <br/>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" class="btn btn-primary mb-2 ml-2 mr-2 mt-4 mb-4" value="{{ route('createoffset')}}">Guardar</button>
</form>
@stop

@section('css')
    <style>
    .btn-circle{width: 50px;
    height: 50px;
    padding: 6px 0px;
    text-align: center;}

    .seleccion{
    width: 250px;
    height: 30px;
    text-align: center;   
    }

    .skere{
    border-color: black;
    border-radius: 2%;  
    width: 600px;
    height: 30px;
    }

    .rango{
        width: 600px;  
    }

    </style>
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@push('js')
<script>
var slider = document.getElementById('range'),
    output= document.getElementById('value');

output.innerHTML = slider.value;

slider.oninput = function() {
	output.innerHTML = this.value;
}
</script>
@endpush

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
@stop
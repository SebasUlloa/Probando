@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1>Tipos de Siembra Solo Monitor</h1>
@stop

@section('content')
<a href="{{ route('createplanting') }}"class="btn btn-dark mb-3">
  <span class="fas fa-plus"></span> Agregar tipo
</a>
<br/>
<div class="btn-group">
<a href="createmonitor" class="btn btn-success" aria-current="page">Machine Data</a>
    <a href="{{ route('productmonitor') }}" class="btn btn-success">Products</a>
    <a href="{{ route('sensorslineamonitor') }}" class="btn btn-success">Sensores por Linea</a>
    <a href="{{ route('actuatorsmonitor') }}" class="btn btn-success">Actuadores</a>
    <a href="{{ route('plantingtypesmonitor') }}" class="btn btn-success">Tipos de siembra</a>   
</div>
<div class="">
  <table id="crucianelli" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
          <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Doble Linea</th>
            <th scope="col">Distancia entre surcos(en metros)</th>
            <th scope="col">Estado</th>
            <th scope="col">Tipos de Siembra</th>
          </tr>
      </thead>
      <tbody>
          @foreach($plantingtypes as $plantingtypes)
          <tr>
            <td>{{ $plantingtypes->ordercode }}</td>
            <td>{{ $plantingtypes->name }}</td>
            <td>{{ $plantingtypes->doubleLineConfig }}</td>
            <td>{{ $plantingtypes->rowDistance }}</td>
            @if($plantingtypes->isActive == 1)
            <td><input type="button" class="btn-success" name='ACTIVADO' value='ACTIVADO' disabled></td>
            @else
            <td><input type="button" class="btn-danger" name='DESACTIVADO' value='DESACTIVADO' disabled></td>
            @endif
            @if($plantingtypes->sowingModeType == 1)
            <td><input type="button" class="btn-white" name='PLACA' value='PLACA' disabled></td>
            @else
            <td><input type="button" class="btn-white" name='CHORILLO' value='CHORILLO' disabled></td>
            @endif
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
<hr/>
  <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
  <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Finalizar</a>
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
@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1>Tipos de Siembra</h1>
@stop

@section('content')
<a href="{{ route('createfullplanting')}}"class="btn btn-dark mb-3">
  <span class="fas fa-plus"></span> Agregar tipo
</a>
<br/>
<div class="btn-group">
<a href="{{ route('createmachine')}}" class="btn btn-success">Machine Data</a>
  <a href="{{ route('products')}}" class="btn btn-success">Products</a>
  <a href="{{ route('sensorsrows')}}" class="btn btn-success">Sensores por Linea</a>
  <a href="{{ route('rowsoffset')}}" class="btn btn-success">Desfasajes de Lineas</a>
  <a href="{{ route('actuators')}}" class="btn btn-success ">Actuadores</a>
  <a href="{{ route('ecus')}}" class="btn btn-success">Ecus</a>
  <a href="{{ route('sensors')}}" class="btn btn-success">Sensores</a>
  <a href="{{ route('configs')}}" class="btn btn-success">Inputs/Outputs Configs</a>
  <a href="{{ route('plantingtypes')}}" class="btn btn-success active">Tipos de siembra</a>
</div>
<div class="">
  <table id="crucianelli" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
          <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Doble Linea</th>
            <th scope="col">Distancia entre surcos(en metros)</th>
            <th scope="col">Estados</th>
            <th scope="col">Dosificacion</th>
            <th scope="col"></th>
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
            <td>
            <form action="{{ route ('deleteplantingtype', $plantingtypes->plantingTypeId)}}" method="POST">
                    <!--Boton Editar -->
                    <a href="crucianelli/{{$plantingtypes->machineId}}/edit" class="btn btn-info"><span class=" fas fa-pencil-alt"></a>
                    @csrf
                    <a href="{{ route ('deleteplantingtype', $plantingtypes->plantingTypeId)}}" class="btn btn-danger"><span class=" far fa-trash-alt"></a>
                    <!--Boton borrar-->
            </form>
            </td>
          </tr>
          @endforeach
      </tbody>
  </table>
</div>

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
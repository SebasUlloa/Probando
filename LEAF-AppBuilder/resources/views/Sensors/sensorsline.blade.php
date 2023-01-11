@extends('adminlte::page')

@section('title', 'Sensors x Surco')

@section('content_header')
    <h2>Cant. de sensores por surco</h2>
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

<h1 class="mt-3">Selecciones Cant. de sensores por surco</h1>

<form action="{{ route('hasmany') }}" method="post">
    @csrf
            <div class="mb-3">
            <label form="" class="col-sm-2 col-form-label col-form-label-sm">Cant. de surcos <?=end($rows); ?></label>
    <div class="col-sm-8">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="icsflex" name="icsflex" >
            <label class="form-check-label" for="icsflex">Reporta ICS</label>
        </div>
        <br/>

        <table id="crucianelli" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
        <thead class="bg-success text-white">
            <tr>
            <th scope="col">#</th>
                <th scope="col">
                
                </th>
        </thead>
        <tbody>
           @php $v = end($rows); @endphp
            @for($i = 0; $i < $v ; $i++)
            <tr>
                <td><?=$i+1?></td>
                <td>
                <div class="sensors-line">
                    <div class="input-group mb-3 mt-4" style="width:130px; height:20px;">
                        <button class="input-group-text decrement-btn">-</button>
                            <input type="text" class="form-control text-center input-line bg-white" value="1"  id="cantidad<?=$i+1?>" name="cantidad<?=$i+1?>">
                        <button class="input-group-text increment-btn">+</button>
                    </div>
                </div>
                </td>
            </tr>
            @endfor
        <br/>
        </tbody>
        </table>
    </div>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('hasmany') }}" class="btn btn-primary">Siguiente</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@push('js')

@endpush

@section('js')
    <script src="{{asset('js\custom.js')}}"></script>   
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
@stop
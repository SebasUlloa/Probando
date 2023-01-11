@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bases de Datos Recientes</h1>
@stop

@section('content')
    <p>Proximamente</p>
    <table id="crucianelli" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Cant. de surcos</th>
            <th scope="col">Distancia surcos(en m)</th>
            <th scope="col">Doble Line</th>
            <th scope="col">Tipo Monitor</th>
            <th scope="col">Fecha</th>
          </tr>
      </thead>
      <tbody>
        
      </tbody>
  </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

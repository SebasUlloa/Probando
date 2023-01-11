@extends('adminlte::page')

@section('title', 'CREAR REGISTROS')

@section('content_header')
    <h2>CREAR REGISTROS</h2>
@stop

@section('content')
<form action="/crucianelli" method="POST">
    @csrf
    <div class="mb-3">
        <label form="" class="form-label">Id</label>
        <input id="codigo" name="codigo" type="text" class="form-control" tabindex="1">
    </div>
    <div class="mb-3">
        <label form="" class="form-label">Name</label>
        <input id="descripcion" name="name" type="text" class="form-control" tabindex="2">
    </div>
    <div class="mb-3">
        <label form="" class="form-label">Descripcion</label>
        <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2">
    </div>
    <div class="mb-3">
        <label form="" class="form-label">rowsQty</label>
        <input id="cantidad" name="rowsQty" type="number" class="form-control" tabindex="3">
    </div>
    <div class="mb-3">
        <label form="" class="form-label">rowsFixedDistance</label>
        <input id="precio" name="rowsFixedDistance" type="number" step="any" value="0.0" class="form-control" tabindex="4">
    </div>
    <div class="mb-3">
        <label form="" class="form-label">doubleLine</label>
        <input id="precio" name="doubleLine" type="number" step="any" value="0.0" class="form-control" tabindex="4">
    </div>
    <div class="mb-3">
        <label form="" class="form-label">machinesFamilyId</label>
        <input id="precio" name="machinesFamilyId" type="number" step="any" value="0.0" class="form-control" tabindex="4">
    </div>
    <a href="/crucianelli" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop
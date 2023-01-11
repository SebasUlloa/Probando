@extends('adminlte::page')

@section('title', 'SELECCION DE PRODUCTOS')

@section('content_header')
    <h2>CREAR REGISTROS</h2>
@stop

@section('content')

<div class="btn-group">
  <a href="{{ route('createmachine')}}" class="btn btn-success">Machine Data</a>
  <a href="{{ route('products')}}" class="btn btn-success active">Products</a>
  <a href="{{ route('sensorsrows')}}" class="btn btn-success">Sensores por Linea</a>
  <a href="{{ route('rowsoffset')}}" class="btn btn-success">Desfasajes de Lineas</a>
  <a href="{{ route('actuators')}}" class="btn btn-success">Actuadores</a>
  <a href="{{ route('ecus')}}" class="btn btn-success">Ecus</a>
  <a href="{{ route('configs')}}" class="btn btn-success">Inputs/Outputs Configs</a>
  <a href="{{ route('plantingtypes')}}" class="btn btn-success">Tipos de siembra</a>
</div>

<h1 class="mt-3">Datos Maquina Solo Monitor</h1>

<form action="{{ route('createprofull') }}" method="POST">
@csrf
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Producto 1</label>
            <div class="radio">
            @foreach($products as $product1)  
                <input class="form-check-input" type="radio" name="product1" id="product1{{ $product1->productlistId }}" value="{{ $product1->productlistId }}">
                <label class="form-check-label" for="product1{{ $product1->productlistId }}">
                    {{ $product1->name}}
                </label>
            @endforeach 
            </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Producto 2</label>
            <div class="radio">
            @foreach($products as $product2)  
                <input class="form-check-input" type="radio" name="product2" id="product2{{ $product2->productlistId }}" value="{{ $product2->productlistId }}">
                <label class="form-check-label" for="product2{{ $product2->productlistId }}">
                    {{ $product2->name}}
                </label>
            @endforeach 
            </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Producto 3</label>
            <div class="radio">
            @foreach($products as $product3)  
                <input class="form-check-input" type="radio" name="product3" id="product3{{ $product3->productlistId }}" value="{{ $product3->productlistId }}">
                <label class="form-check-label" for="product3{{ $product3->productlistId }}">
                    {{ $product3->name}}
                </label>
            @endforeach 
            </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-3 col-form-label col-form-label-sm">Producto 4</label>
            <div class="radio">
            @foreach($products as $product4)  
                <input class="form-check-input" type="radio" name="product4" id="product4{{ $product4->productlistId }}" value="{{ $product4->productlistId }}">
                <label class="form-check-label" for="product4{{ $product4->productlistId }}">
                    {{ $product4->name}}
                </label>
            @endforeach 
            </div>
    </div>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('createprofull') }}" class="btn btn-primary">Siguiente</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@section('js')
@stop
@extends('adminlte::page')

@section('title', 'SELECCION DE PRODUCTOS')

@section('content_header')
    <h2>CREAR REGISTROS</h2>
@stop

@section('content')

<div class="btn-group">
<a href="createmonitor" class="btn btn-success" aria-current="page">Machine Data</a>
    <a href="{{ route('productmonitor') }}" class="btn btn-success">Products</a>
    <a href="{{ route('sensorslineamonitor') }}" class="btn btn-success">Sensores por Linea</a>
    <a href="{{ route('actuatorsmonitor') }}" class="btn btn-success">Actuadores</a>
    <a href="{{ route('plantingtypesmonitor') }}" class="btn btn-success">Tipos de siembra</a>   
</div>
<h1 class="mt-3">Productos Maquina Solo Monitor</h1>

<form action="{{ route('createproductmonitor') }}" method="POST">
    @csrf
    <div class="">
    <div>
        <label class="form-check-label" for="product1">Product 1</label>
        <select class="form-select-sm mb-3" aria-label=".form-select-lg example" id="product1" name="product1">
            <option value="NULL">Select..</option>
            @foreach($stuff_types as $product1)  
                <option value="{{ $product1->productlistId }}">{{ $product1->name}}</option>
            @endforeach 
        </select>
    </div>
    <div>
        <label class="form-check-label" for="product2">Product 2</label>
        <select class="form-select-sm mb-3" aria-label=".form-select-lg example" id="product2" name="product2">
        <option value="NULL">Select..</option>
            @foreach($stuff_types as $product2)  
                <option value="{{ $product2->productlistId }}">{{ $product2->name}}</option>
            @endforeach 
        </select>
    </div>
    <div>
        <label class="form-check-label" for="product1">Product 3</label>
        <select class="form-select-sm mb-3" aria-label=".form-select-lg example" id="product3" name="product3">
        <option value="NULL">Select..</option>
            @foreach($stuff_types as $product3)  
                <option value="{{ $product3->productlistId }}">{{ $product3->name}}</option>
            @endforeach 
        </select>
    </div>
    <div>
        <label class="form-check-label" for="product2">Product 4</label>
        <select class="form-select-sm mb-3" aria-label=".form-select-lg example" id="product4" name="product4">
        <option value="NULL">Select..</option>
            @foreach($stuff_types as $product4)  
                <option value="{{ $product4->productlistId }}">{{ $product4->name}}</option>
            @endforeach 
        </select>
    </div>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <!--<button type="submit" class="btn btn-primary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="9">Guardar</button>-->
    <button type="submit" value="{{ route('createproductmonitor') }}" class="btn btn-primary">Siguiente</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@section('js')
@stop
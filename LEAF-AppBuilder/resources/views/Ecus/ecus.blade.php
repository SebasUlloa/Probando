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
  <a href="{{ route('actuators')}}" class="btn btn-success">Actuadores</a>
  <a href="{{ route('ecus')}}" class="btn btn-success active">Ecus</a>
  <a href="{{ route('sensors')}}" class="btn btn-success">Sensores</a>
  <a href="{{ route('configs')}}" class="btn btn-success">Inputs/Outputs Configs</a>
  <a href="{{ route('plantingtypes')}}" class="btn btn-success">Tipos de siembra</a>
</div>
<h1 class="mt-3">Ecus Config</h1>
<hr/>
<!----- ACA ESTAN LAS ECUS----->
<form action="{{ route('createecus')}}" method="POST">
    @csrf
    <div class="">
        <label form="" class="form-label">Seleccione tipo de Ecu</label>
        @foreach($ecu as $ecu)
        <div class="row ">
            <div class="item col checkbox-container-fert1">
                <input type="checkbox" name="{{$ecu->ecu_listId}}" id="{{$ecu->ecu_listId}}">
                <label class="label" for="{{$ecu->ecu_listId}}">{{$ecu->name}}</label>
            </div>
            <div class="item col mt-4">
                <input id="CANT-{{$ecu->name}}" name="CANT-{{$ecu->name}}" type="number" class="seleccion" placeholder="Cantidad">
            </div>
        </div>
        @endforeach
    </div>
    <br/>
    <br/>
<!----- ACA ESTAN LOS ACTUADORES----->
<hr/>
    <br/>
    <div class="d-grid gap-2 d-md-flex me-md-2 btn-guardar">
        <a href="/crucianelli" class="btn btn-warning  me-md-2" tabindex="8">Volver</a>
        <a href="/crucianelli" class="btn btn-danger  me-md-2" tabindex="8"><span class="	far fa-trash-alt"></span></a>
        <button type="submit" class="btn btn-primary me-md-2" value="{{ route('createecus')}}">Siguiente</button>
    </div>
</form>
@stop

@section('css')
    <style>
    .btn-circle{width: 50px;
    height: 50px;
    padding: 6px 0px;
    text-align: center;}

    .seleccion{
    width: 238px;
    height: 30px;
    text-align: center;   
    }

    .btn-guardar{
    margin-left: 400px;
    align-items: center;   
    }

    .checkbox-container{
	margin-bottom: 2rem;
	max-width: 1200px;
	margin: 0 auto;
	display: flex;
}


.label{
	font-size: 18px;
	width: 135px;
    height: 35px;
	border: 1px solid grey;
	transition: 0.5s;
	border-radius: 5px;
    margin-left: 8px;
    margin-right: 5px;
	display: flex;
	justify-content: center;
	align-items: center;
	cursor: pointer;
}

.checkbox-container-fert1 input[type="checkbox"]:checked ~ .label{
    border-top: 1px solid red;
	border-left: 1px solid red;
	border-bottom: 1px solid red;
	border-right: 1px solid red;
	background: linear-gradient(45deg, red, red);
	color: white;
}

.checkbox-container-fert1 input[type="checkbox"]{
     visibility: hidden;
}

input[type="checkbox"]:checked ~ .label{
	border-top: 1px solid #00be95;
	border-left: 1px solid #00be95;
	border-bottom: 1px solid #00aebe;
	border-right: 1px solid #00aebe;
	background: linear-gradient(45deg, #00aebe, #00be95);
	color: white;
}
    </style>
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
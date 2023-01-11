@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="btn-group">
<a href="createmonitor" class="btn btn-success" aria-current="page">Machine Data</a>
    <a href="{{ route('productmonitor') }}" class="btn btn-success">Products</a>
    <a href="{{ route('sensorslineamonitor') }}" class="btn btn-success">Sensores por Linea</a>
    <a href="{{ route('actuatorsmonitor') }}" class="btn btn-success">Actuadores</a>
    <a href="{{ route('plantingtypesmonitor') }}" class="btn btn-success">Tipos de siembra</a>   
</div>
<h1 class="mt-3">Actuadores</h1>
<hr/>
<form action="{{ route('hassensors') }}" method="post">
@csrf
    <div class="mb-3">
    <div class="col-sm-8">
    <br/>      
            <h6>Seleccione cantidad de sensores</h6>
            @php $cantidad = 8 @endphp
    <br/>
        <div class="">
            <table>
            @foreach($sensors as $sens)
                <div class="row ">
                    <tr>
                    <td>
                        <div class="item col checkbox-container-fert1">
                        <input type="checkbox" name="{{$sens->name}}" id="{{$sens->name}}">
                        <label class="label" for="{{$sens->name}}">{{$sens->name}}</label>
                        </div>
                    </td>
                
                    <td>
                    <div class="item col mt-4">
                        <input id="CANT-{{$sens->name}}" name="CANT-{{$sens->name}}" type="number" class="seleccion" placeholder="Cantidad">
                    </div>
                    </td>
                </tr>
                </div>
                @endforeach
            </div>
        </table>
    </div>
</div>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('hassensors') }}" class="btn btn-primary">Siguiente</button>
</form>
@stop

@section('css')
    <style>
    .seleccion{
    width: 238px;
    height: 30px;
    text-align: center;   
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
.checkbox-container-fert1 input[type="checkbox-inline"]:checked ~ .label{
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
.checkbox-container-fert1 input[type="checkbox-inline"]{
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
input[type="checkbox-inline"]:checked ~ .label{
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
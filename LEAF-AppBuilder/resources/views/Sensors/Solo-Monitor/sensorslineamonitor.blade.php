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
<h1 class="mt-3">Configuracion Lectura de Sensores por Producto</h1>
<hr/>
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
                <td><input id="row" name="row" type="text" class="form-control form-control-s" value="<?=$i+1?>" disabled></td>
                <td><input id="cantidad" name="cantidad<?=$i+1?>" type="number" class="form-control form-control-s" value="<?=$l=1;?>"></td>
               
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

    </style>
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@push('js')
<script>
    var switchStatus = false;
      $( '#icsflex').on( 'change', function() {
    if( $(this).is(':checked') ){
        $(this).attr('value','true');
        switchStatus = $(this).is(':checked');
        // Hacer algo si el checkbox ha sido seleccionado
        //alert("El checkbox con valor ");
    } else {
        switchStatus = $(this).is(':checked');
        // Hacer algo si el checkbox ha sido deseleccionado
        //alert("El checkbox NO valor ");
    }
});


</script>
@endpush

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
@stop

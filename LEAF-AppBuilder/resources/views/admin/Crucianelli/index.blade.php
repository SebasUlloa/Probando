@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1>Listado Data Bases Crucianelli</h1>
@stop

@section('content')
<a href="admin/crucianelli/create" class="btn btn-primary mb-3" >CREAR</a>

<table id="crucianelli" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cant. de surcos</th>
            <th scope="col">Distancia entre surcos(en metros)</th>
            <th scope="col">Doble Line</th>
            <th scope="col">MachineFamili</th>
        </tr>
    </thead>
    <tbody>
        @foreach($crucianelli as $crucianelli)
        <tr>
            <td>{{ $crucianelli->machineId }}</td>
            <td>{{ $crucianelli->name }}</td>
            <td>{{ $crucianelli->descripcion }}</td>
            <td>{{ $crucianelli->rowsQty }}</td>
            <td>{{ $crucianelli->rowsFixedDistance }}</td>
            <td>{{ $crucianelli->doubleLineConfigs }}</td>
            <td>{{ $crucianelli->machinesFamilyId }}</td>
            <td>
                <form action="{{ route ('crucianelli.destroy', $crucianelli->id)}}" method="POST">
                    <a href="crucianelli/{{$crucianelli->id}}/edit" class="btn btn-info">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // ACA ES LA PAGINACION
        $(document).ready(function() {
            $('#crucianelli').DataTable({
                "lengthMenu": [[5,10, 50, -1], [5, 10, 50, "All"]]
            });
        } );
    </script>
@stop
@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1>Listado Data Bases Erca</h1>
@stop

@section('content')
<a href="erca/create"class="btn btn-dark mb-3">
  <span class="fas fa-plus"></span> New Machine
</a>
<br/>

<button type="button" class="btn btn-success"  data-bs-target="#collapse1" data-bs-toggle="collapse" aria-controls="collapse1" aria-expanded="false">
    Erca Especial Machines
</button>

<div class="collapse" id="collapse1">
  <table id="erca" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
          <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cant. de surcos</th>
            <th scope="col">Distancia entre surcos(en metros)</th>
            <th scope="col">Doble Line</th>
            <th scope="col"></th>
          </tr>
      </thead>
      <tbody>
          @foreach($erca as $erca)
          <tr>
            <td>{{ $erca->machineId }}</td>
            <td>{{ $erca->name }}</td>
            <td>{{ $erca->description }}</td>
            <td>{{ $erca->rowsQty }}</td>
            <td>{{ $erca->rowsFixedDistance }}</td>
            <td>{{ $erca->doubleLineConfigs }}</td>
            <td>
                <form action="{{ route ('erca.destroy', $erca->machineId)}}" method="POST">
                    <a href="#" class="btn btn-dark">
                      <span class="	fas fa-download"></span>
                    </a>
                    <a href="erca/{{$erca->machineId}}/edit" class="btn btn-info">
                      <span class="	fas fa-pencil-alt"></span>
                    </a>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger 	far fa-trash-alt"></button>
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
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@stop
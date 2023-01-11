@extends('adminlte::page')

@section('title', 'LEAF')

@section('content_header')
    <h1>Listado Data Bases Crucianelli</h1>
@stop

@section('content')
<a href="crucianelli/create"class="btn btn-dark mb-3">
  <span class="fas fa-plus"></span> New Machine
</a>
<a href="{{ route('createmonitor') }}"class="btn btn-danger mb-3">
  <span class="fas fa-plus"></span> New Monitor Machine 
</a>
<br/>

<button type="button" class="btn btn-success"  data-bs-target="#collapse1" data-bs-toggle="collapse" aria-controls="collapse1" aria-expanded="false">
    Gringa Machines
</button>

<div class="collapse" id="collapse1">
  <table id="crucianelli" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
          <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cant. de surcos</th>
            <th scope="col">Distancia surcos(en m)</th>
            <th scope="col">Doble Line</th>
            <th scope="col">Tipo Monitor</th>
            <th scope="col"></th>
          </tr>
      </thead>
      <tbody>
        @foreach($crucianelli as $crucianelli)
          @if($crucianelli->machineFamilyId == 1)
        <tr>
          <td>{{ $crucianelli->machineId }}</td>
          <td>{{ $crucianelli->name }}</td>
          <td>{{ $crucianelli->description }}</td>
          <td>{{ $crucianelli->rowsQty }}</td>
          <td>{{ $crucianelli->rowsFixedDistance }}</td>
          @if($crucianelli->doubleLineConfig == 0)
          <td></td>
          @else
          <td><i class="fa fa-toggle-on" style="font-size:30px;color:green"></i></td>
          @endif
          @if($crucianelli->monitor_model == 0)
          <td><input type="button" class="btn-white" name='MAP7-PRO' value='MAP7-PRO' disabled></td>
          @else
          <td><input type="button" class="btn-white" name='ORIZON' value='ORIZON' disabled></td>
          @endif
          <td>
            <form action="{{ route ('crucianelli.destroy', $crucianelli->machineId)}}" method="POST">
                    <!--Boton descarga-->
                    <a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>
                    <!--<a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>-->
                      <!--Boton Resumen PDF-->
                      <a href="{{ route('download-pdf') }}" class="btn btn-warning"><span class=" fas fa-print"></a>
                    <!--Boton Editar-->
                    <a href="crucianelli/{{$crucianelli->machineId}}/edit" class="btn btn-info"><span class=" fas fa-pencil-alt"></a>
                    @csrf
                    @method('DELETE')
                    <!--Boton borrar-->
                    <button type="submit" class="btn btn-danger far fa-trash-alt"></button>
            </form>
          </td>
        </tr>
          @endif 
        @endforeach      
      </tbody>
  </table>
</div>
<!-----------------------------------------------PIONERA---------------------------------------------------->

<button type="button" class="btn btn-success"  data-bs-target="#collapse2" data-bs-toggle="collapse" aria-controls="collapse2" aria-expanded="false">
    Pionera Machines
</button>

<div class="collapse" id="collapse2">
  <table id="crucianelli2" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
          <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cant. de surcos</th>
            <th scope="col">Distancia surcos(en m)</th>
            <th scope="col">Doble Line</th>
            <th scope="col">Tipo Monitor</th>
            <th scope="col"></th>
          </tr>
      </thead>
      <tbody>
      @foreach($pionera as $pionera)
        <tr>
          <td>{{ $pionera->machineId }}</td>
          <td>{{ $pionera->name }}</td>
          <td>{{ $pionera->description }}</td>
          <td>{{ $pionera->rowsQty }}</td>
          <td>{{ $pionera->rowsFixedDistance }}</td>
          @if($pionera->doubleLineConfig == 0)
          <td></td>
          @else
          <td><i class="fa fa-toggle-on" style="font-size:30px;color:green"></i></td>
          @endif
          @if($pionera->monitor_model == 0)
          <td><input type="button" class="btn-white" name='MAP7-PRO' value='MAP7-PRO' disabled></td>
          @else
          <td><input type="button" class="btn-white" name='ORIZON' value='ORIZON' disabled></td>
          @endif
          <td>
            <form action="{{ route ('crucianelli.destroy', $crucianelli->machineId)}}" method="POST">
                    <!--Boton descarga-->
                    <a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>
                    <!--<a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>-->
                      <!--Boton Resumen PDF-->
                      <a href="{{ route('download-pdf') }}" class="btn btn-warning"><span class=" fas fa-print"></a>
                    <!--Boton Editar-->
                    <a href="crucianelli/{{$crucianelli->machineId}}/edit" class="btn btn-info"><span class=" fas fa-pencil-alt"></a>
                    @csrf
                    @method('DELETE')
                    <!--Boton borrar-->
                    <button type="submit" class="btn btn-danger far fa-trash-alt"></button>
            </form>
          </td>
        </tr>
        @endforeach  
      </tbody>
  </table>
</div>
<!-----------------------------------------------DRILLOR---------------------------------------------------->
<button type="button" class="btn btn-success"  data-bs-target="#collapse3" data-bs-toggle="collapse" aria-controls="collapse3" aria-expanded="false">
    Drillor Machines
</button>

<div class="collapse" id="collapse3">
  <table id="crucianelli2" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
          <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cant. de surcos</th>
            <th scope="col">Distancia surcos(en m)</th>
            <th scope="col">Doble Line</th>
            <th scope="col">Tipo Monitor</th>
            <th scope="col"></th>
          </tr>
      </thead>
      <tbody>
      @foreach($drillor as $drillor)
        <tr>
          <td>{{ $drillor->machineId }}</td>
          <td>{{ $drillor->name }}</td>
          <td>{{ $drillor->description }}</td>
          <td>{{ $drillor->rowsQty }}</td>
          <td>{{ $drillor->rowsFixedDistance }}</td>
          @if($drillor->doubleLineConfig == 0)
          <td></td>
          @else
          <td><i class="fa fa-toggle-on" style="font-size:30px;color:green"></i></td>
          @endif
          @if($drillor->monitor_model == 0)
          <td><input type="button" class="btn-white" name='MAP7-PRO' value='MAP7-PRO' disabled></td>
          @else
          <td><input type="button" class="btn-white" name='ORIZON' value='ORIZON' disabled></td>
          @endif
          <td>
            <form action="{{ route ('crucianelli.destroy', $crucianelli->machineId)}}" method="POST">
                    <!--Boton descarga-->
                    <a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>
                    <!--<a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>-->
                      <!--Boton Resumen PDF-->
                      <a href="{{ route('download-pdf') }}" class="btn btn-warning"><span class=" fas fa-print"></a>
                    <!--Boton Editar-->
                    <a href="crucianelli/{{$crucianelli->machineId}}/edit" class="btn btn-info"><span class=" fas fa-pencil-alt"></a>
                    @csrf
                    @method('DELETE')
                    <!--Boton borrar-->
                    <button type="submit" class="btn btn-danger far fa-trash-alt"></button>
            </form>
          </td>
        </tr>
        @endforeach 
      </tbody>
  </table>
</div>
<!-----------------------------------------------PLANTOR---------------------------------------------------->
<button type="button" class="btn btn-success"  data-bs-target="#collapse4" data-bs-toggle="collapse" aria-controls="collapse4" aria-expanded="false">
    Plantor Machines
</button>

<div class="collapse" id="collapse4">
  <table id="crucianelli2" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
          <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cant. de surcos</th>
            <th scope="col">Distancia surcos(en m)</th>
            <th scope="col">Doble Line</th>
            <th scope="col">Tipo Monitor</th>
            <th scope="col"></th>
          </tr>
      </thead>
      <tbody>
      @foreach($plantor as $plantor)
        <tr>
          <td>{{ $plantor->machineId }}</td>
          <td>{{ $plantor->name }}</td>
          <td>{{ $plantor->description }}</td>
          <td>{{ $plantor->rowsQty }}</td>
          <td>{{ $plantor->rowsFixedDistance }}</td>
          @if($plantor->doubleLineConfig == 0)
          <td></td>
          @else
          <td><i class="fa fa-toggle-on" style="font-size:30px;color:green"></i></td>
          @endif
          @if($plantor->monitor_model == 0)
          <td><input type="button" class="btn-white" name='MAP7-PRO' value='MAP7-PRO' disabled></td>
          @else
          <td><input type="button" class="btn-white" name='ORIZON' value='ORIZON' disabled></td>
          @endif
          <td>
            <form action="{{ route ('crucianelli.destroy', $crucianelli->machineId)}}" method="POST">
                    <!--Boton descarga-->
                    <a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>
                    <!--<a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>-->
                      <!--Boton Resumen PDF-->
                      <a href="{{ route('download-pdf') }}" class="btn btn-warning"><span class=" fas fa-print"></a>
                    <!--Boton Editar-->
                    <a href="crucianelli/{{$crucianelli->machineId}}/edit" class="btn btn-info"><span class=" fas fa-pencil-alt"></a>
                    @csrf
                    @method('DELETE')
                    <!--Boton borrar-->
                    <button type="submit" class="btn btn-danger far fa-trash-alt"></button>
            </form>
          </td>
        </tr>
        @endforeach 
      </tbody>
  </table>
</div>
<!-----------------------------------------------ESPECIALES---------------------------------------------------->
<button type="button" class="btn btn-success"  data-bs-target="#collapse5" data-bs-toggle="collapse" aria-controls="collapse5" aria-expanded="false">
    Especial Machines
</button>

<div class="collapse" id="collapse5">
  <table id="crucianelli2" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
      <thead class="bg-success text-white">
          <tr>
          <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cant. de surcos</th>
            <th scope="col">Distancia surcos(en m)</th>
            <th scope="col">Doble Line</th>
            <th scope="col">Tipo Monitor</th>
            <th scope="col"></th>
          </tr>
      </thead>
      <tbody>
      @foreach($especial as $especial)
        <tr>
          <td>{{ $especial->machineId }}</td>
          <td>{{ $especial->name }}</td>
          <td>{{ $especial->description }}</td>
          <td>{{ $especial->rowsQty }}</td>
          <td>{{ $especial->rowsFixedDistance }}</td>
          @if($especial->doubleLineConfig == 0)
          <td></td>
          @else
          <td><i class="fa fa-toggle-on" style="font-size:30px;color:green"></i></td>
          @endif
          @if($especial->monitor_model == 0)
          <td><input type="button" class="btn-white" name='MAP7-PRO' value='MAP7-PRO' disabled></td>
          @else
          <td><input type="button" class="btn-white" name='ORIZON' value='ORIZON' disabled></td>
          @endif
          <td>
            <form action="{{ route ('crucianelli.destroy', $crucianelli->machineId)}}" method="POST">
                    <!--Boton descarga-->
                    <a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>
                    <!--<a href="generar/{{$crucianelli->machineId}}" class="btn btn-dark"><span class=" fas fa-download"></span></a>-->
                      <!--Boton Resumen PDF-->
                      <a href="{{ route('download-pdf') }}" class="btn btn-warning"><span class=" fas fa-print"></a>
                    <!--Boton Editar-->
                    <a href="crucianelli/{{$crucianelli->machineId}}/edit" class="btn btn-info"><span class=" fas fa-pencil-alt"></a>
                    @csrf
                    @method('DELETE')
                    <!--Boton borrar-->
                    <button type="submit" class="btn btn-danger far fa-trash-alt"></button>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@stop
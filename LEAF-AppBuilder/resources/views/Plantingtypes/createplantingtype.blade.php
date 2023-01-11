@extends('adminlte::page')

@section('title', '')

@section('content_header')
    <h2></h2>
@stop

@section('content')
<div class="btn-group">
  <a href="{{ route('createmachine')}}" class="btn btn-success">Machine Data</a>
  <a href="{{ route('products')}}" class="btn btn-success">Products</a>
  <a href="{{ route('sensorsrows')}}" class="btn btn-success">Sensores por Linea</a>
  <a href="{{ route('rowsoffset')}}" class="btn btn-success">Desfasajes de Lineas</a>
  <a href="{{ route('actuators')}}" class="btn btn-success ">Actuadores</a>
  <a href="{{ route('ecus')}}" class="btn btn-success">Ecus</a>
  <a href="{{ route('sensors')}}" class="btn btn-success">Sensores</a>
  <a href="{{ route('configs')}}" class="btn btn-success">Inputs/Outputs Configs</a>
  <a href="{{ route('plantingtypes')}}" class="btn btn-success">Tipos de siembra</a>
</div>

<h1 class="mt-3">Tipos de Siembra</h1>

<form action="{{ route('savefullPlanting') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label form="" class="col-sm-2 col-form-label col-form-label-sm">PlantingTypeId</label>
        <div class="col-sm-8">
        <input id="plantingTypeId" name="plantingTypeId" type="text" class="form-control form-control-sm" value="<?=$lastId?>" tabindex="1">
        </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-2 col-form-label col-form-label-sm">MachineId</label>
        <div class="col-sm-8">
        <input id="machineId" name="machineId" type="number" class="form-control form-control-sm" tabindex="2" value="2" disabled>
        </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
        <div class="col-sm-8">
        <input id="name" name="name" type="text" class="form-control form-control-sm" tabindex="3">
        </div>
    </div>
    <div class="mb-3">
        <label form="" class="col-sm-2 col-form-label col-form-label-sm">rowDistance</label>
        <div class="col-sm-8">
        <input id="rowDistance" name="rowDistance" type="float" class="form-control form-control-sm" tabindex="5">
        </div>
    </div>
    <div class="form-check form-check-inline form-switch">
            <input class="form-check-input" type="checkbox" id="doblelinea" name="doblelinea" >
            <label class="form-check-label" for="doblelinea">Doble Linea Config</label>
    </div>
    <div class="form-check form-check-inline form-switch">
            <input class="form-check-input" type="checkbox" id="isactive" name="isactive" >
            <label class="form-check-label" for="isactive">isActive</label>
    </div>
    <div class="form-check form-check-inline form-switch">
            <input class="form-check-input" type="checkbox" id="sowing" name="sowing" >
            <label class="form-check-label" for="sowing">sowingModeType</label>
    </div>
    <br/>
    @foreach($productmachine as $key)
    <div class="checkbox-container">
        <table>
            <tr border-right-width="20px" border-left-width="20px">
                <div class="checkbox-container-productos">
                    <input type="checkbox" class="chk-box" name="<?='PRO'.$key->name?>" id="<?='PRO'.$key->name?>">
                    <label class="label" for="PRO<?=$key->name?>">{{$key->name}}</label>
                </div>
            </tr>
            <tr>
                <div class="product-seccion">
                <div class="input-group mb-3 mt-4" style="width:130px; height:20px;">
                    <button class="input-group-text decrement-btn">-</button>
                        <input type="text" class="form-control text-center input-qty bg-white" value="0"  id="SECCION-{{$key->name}}" name="SECCION-{{$key->name}}">
                        <button class="input-group-text increment-btn">+</button>
                </div>
                </div>
            </tr>
            <tr  border-right-width="20px" border-left-width="20px">
                <div class="checkbox-container-productos">
               <input type="checkbox" class="chk-box" id="PRI{{$key->name}}" name="PRI<?=$key->name?>" >
               <label class="label" for="PRI<?=$key->name?>">Principal</label>
               </div>
            </tr>
        </table>
    </div>
    @endforeach
    <hr/>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="{{ route('prosenprofull') }}">
    Sensores por Producto
    </button>
    <!--MODAL-->
    <div div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollable">Seleecione sus sensores por producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('prosenprofull') }}" method="POST">
                @for($i = 1; $i <= $rows; $i++)                
                    <div class="checkbox-container">
                        <!--CHECK SEMILLA-->
                        <div class="checkbox-container-surco">
                            <input class="btn btn-dark mb-2 ml-2 mr-2 mt-2 mb-2" type="button" id="SURCO{{$i}}" name="SURCO{{$i}}" disabled>
                        </div>
                        
                        <div class="checkbox-container-semilla">
                            <input type="checkbox" class="chk-box"  name="SEM<?=$i?>" id="SEM<?=$i?>">
                            <label class="label" for="SEM<?=$i?>">SEM<?=$i?></label>
                        </div>
                        
                        <!--CHECK FERT1-->
                        <div class="checkbox-container-fert1">
                            <input type="checkbox" name="FERTU<?=$i?>" id="FERTU<?=$i?>">
                            <label class="label" for="FERTU<?=$i?>">FERT.1-S<?=$i?></label>
                        </div>
                        <!--CHECK FERT2-->
                        <div class="checkbox-container-fert2">
                            <input type="checkbox" name="FERTD<?=$i?>" id="FERTD<?=$i?>">
                            <label class="label" for="FERTD<?=$i?>">FERT.2-S<?=$i?></label>
                        </div>
                        <!--CHECK ALFALFA-->
                        <div class="checkbox-container-alfalfa">
                            <input type="checkbox" name="ALFA<?=$i?>" id="ALFA<?=$i?>">
                            <label class="label" for="ALFA<?=$i?>">ALFA-S<?=$i?></label>
                        </div>
                    </div>
                    <!--<button type="button" value="false" name="S//$i"  id="S//$i" onClick="test(this.id,this.value,//$i?>)" class="btn btn-outline-success mb-2 ml-2 mr-2 mt-2 mb-2" tabindex="20">S-//$i?></button>-->
                    
                    <br/>
                @endfor
            </form>
        </div>
        <div class="modal-footer">
            <div class="checkbox-container-todos">
                <input type="checkbox" class="select-all" name="TODOS" id="TODOS" />
                <label class="label-checkbox-container-todos" for="TODOS">Seleccionar Todos</label>
            </div>
            <div class="checkbox-container-par">
                <input type="checkbox" class="select-par" name="par" id="par" />
                <label class="label-checkbox-container-par" for="par">Seleccion Par</label>
            </div>
            <div class="checkbox-container-impar">
                <input type="checkbox" class="select-impar" name="impar" id="impar" />
                <label class="label-checkbox-container-impar" for="impar">Seleccion Impar</label>
            </div>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" value="{{ route('prosenprofull') }}">Save changes</button>
        </div>
        </div>
  </div>
    </div>
    <!--FIN DEL MODAL-->
    <hr/>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('savefullPlanting') }}" class="btn btn-primary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="9">Guardarx</button>
</form>
@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    
@stop
@push('js')
<script>
    
</script>
@endpush
@section('js')
    <script src="{{asset('js\custom.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@stop
@extends('adminlte::page')

@section('title', '')

@section('content_header')
    <h2></h2>
@stop

@section('content')
<div class="btn-group">
    <a href="createmonitor" class="btn btn-success" aria-current="page">Machine Data</a>
    <a href="productsmonitor" class="btn btn-success">Products</a>
    <a href="sensorslineamonitor" class="btn btn-success">Sensores por Linea</a>
    <a href="actuatorsmonitor" class="btn btn-success">Actuadores</a>
    <a href="plantingtypesmonitor" class="btn btn-success">Tipos de siembra</a> 
</div>

<h1 class="mt-3">Tipos de Siembra Solo Monitor</h1>

<form action="{{ route('savePlanting') }}" method="POST">
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
    <div class="form-check form-check  mb-2 ml-8 mr-1">
        <table>
            <tr border-right-width="20px" border-left-width="20px">
               <input class="form-check-input" type="checkbox" name="<?='PRO'.$key->name?>" id="<?='PRO'.$key->name?>">
               <label class="form-check-label" for="<?='PRO'.$key->name?>">{{$key->name}}</label>
            </tr>
            <tr  border-right-width="20px" border-left-width="20px">
               <input class="form-check-input-inline" type="checkbox" id="P{{$key->ordercode}}" name="<?='PRI'.$key->name?>" >
               <label class="form-check-label" for="<?='PRI'.$key->name?>">Principal</label>
            </tr>
        </table>
    </div>
    @endforeach
    <hr/>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="{{ route('prosenpro') }}">
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
            <form action="{{ route('prosenpro') }}" method="POST">
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
            <div>
                <input type="checkbox" class="select-all" /><span>asd</span>
            </div>
            
           
            <button type="button" class="btn btn-primary mb-2 ml-2 mr-2 mt-4 mb-4">Seleccionar Pares</button>
            <button type="button" class="btn btn-warning mb-2 ml-2 mr-2 mt-4 mb-4">Seleccionar Impares</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" value="{{ route('prosenpro') }}">Save changes</button>
        </div>
        </div>
  </div>
    </div>
    <!--FIN DEL MODAL-->
    <hr/>
    <a href="/crucianelli" class="btn btn-secondary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="8">Cancelar</a>
    <button type="submit" value="{{ route('savePlanting') }}" class="btn btn-primary mb-2 ml-2 mr-2 mt-4 mb-4" tabindex="9">Guardarx</button>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
.checkbox-container{
	margin-bottom: 2rem;
	max-width: 1200px;
	margin: 0 auto;
	display: flex;
}


.label{
	font-size: 18px;
	width: 95px;
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

.checkbox-container-semilla input[type="checkbox"]{
     visibility: hidden;
}

.checkbox-container-semilla input[type="checkbox"]:checked ~ .label{
    border-top: 1px solid green;
	border-left: 1px solid green;
	border-bottom: 1px solid green;
	border-right: 1px solid green;
	background: linear-gradient(45deg, green, green);
	color: white;
}
.checkbox-container-fert1 input[type="checkbox"]:checked ~ .label{
    border-top: 1px solid red;
	border-left: 1px solid red;
	border-bottom: 1px solid red;
	border-right: 1px solid red;
	background: linear-gradient(45deg, red, red);
	color: white;
}
.checkbox-container-alfalfa input[type="checkbox"]:checked ~ .label{
    border-top: 1px solid yellow;
	border-left: 1px solid yellow;
	border-bottom: 1px solid yellow;
	border-right: 1px solid yellow;
	background: linear-gradient(45deg, #888806, #888806);
	color: white;
}

.checkbox-container-fert1 input[type="checkbox"]{
     visibility: hidden;
}
.checkbox-container-fert2 input[type="checkbox"]{
     visibility: hidden;
}
.checkbox-container-alfalfa input[type="checkbox"]{
     visibility: hidden;
}
.checkbox-container-surco input[type="button"]{
border-bottom-width: 15px;
border-top-width: -45px;
margin-top: 17px;
border-left-width: -4px;
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
@stop

@push('js')
<script>
    var dobleStatus = false;
      $( '#doblelinea').on( 'change', function() {
    if( $(this).is(':checked') ){
        $(this).attr('value','true');
        dobleStatus = $(this).is(':checked');
        // Hacer algo si el checkbox ha sido seleccionado
        alert("Doble Linea Activado");
    } else {
        dobleStatus = $(this).is(':checked');
        // Hacer algo si el checkbox ha sido deseleccionado
        alert("Doble Linea Desactivado");
    }
    });

    var isactive = false;
        $( '#isactive').on( 'change', function() {
        if( $(this).is(':checked') ){
            $(this).attr('value','true');
            isactive = $(this).is(':checked');
            // Hacer algo si el checkbox ha sido seleccionado
            alert("Activado");
        } else {
            isactive = $(this).is(':checked');
            // Hacer algo si el checkbox ha sido deseleccionado
            alert("Desactivado");
        }
    });

    var sowing = false;
        $( '#sowing').on( 'change', function() {
        if( $(this).is(':checked') ){
            $(this).attr('value','true');
            sowing = $(this).is(':checked');
            // Hacer algo si el checkbox ha sido seleccionado
            alert("sowing ACTIVADO");
        } else {
            sowing = $(this).is(':checked');
            // Hacer algo si el checkbox ha sido deseleccionado
            alert("sowing DESACTIVADO ");
        }
    });

    var semillaanda = false;
        $( '#SEMILLA').on( 'change', function() {
        if( $(this).is(':checked') ){
            $(this).attr('value','true');
            sowing = $(this).is(':checked');
            // Hacer algo si el checkbox ha sido seleccionado
            alert("semillaanda ACTIVADO");
        } else {
            semillaanda = $(this).is(':checked');
            // Hacer algo si el checkbox ha sido deseleccionado
            alert("semillaanda DESACTIVADO ");
        }
    });

    $('document').ready(function()
{
 $(".select-all").click(function () 
 {
  $('.chk-box').attr('checked', this.checked)
 });
  
 $(".chk-box").click(function()
 {
  if($(".chk-box").length == $(".chk-box:checked").length) 
  {
   $(".select-all").attr("checked", "checked");
  } 
  else 
  {
   $(".select-all").removeAttr("checked");
  }
 });
});
</script>
@endpush

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
@stop
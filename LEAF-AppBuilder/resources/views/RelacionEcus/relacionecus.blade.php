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
  <a href="{{ route('actuators')}}" class="btn btn-success ">Actuadores</a>
  <a href="{{ route('ecus')}}" class="btn btn-success">Ecus</a>
  <a href="{{ route('sensors')}}" class="btn btn-success">Sensores</a>
  <a href="{{ route('configs')}}" class="btn btn-success active">Inputs/Outputs Configs</a>
  <a href="{{ route('plantingtypes')}}" class="btn btn-success">Tipos de siembra</a>
</div>
<h1 class="mt-3">Inputs / Outputs Config</h1>
<hr/>
<!----- ACA ESTAN LOS SENSORES ECU ACTUATORS----->
<form action="{{ route('setconfigs')}}" method="POST">
    @csrf
    <h6>Seleccione adress correspondiente por actuador</h6>
    <br/>
    <table id="ecuoutput" class="table table-striped table-bordered shadow-lg mt-2" style="width:100%">
    <thead class="bg-success text-white">
          <tr>
            <th scope="col">ACTUATOR</th>
            <th scope="col">SUBTYPE</th>
            <th scope="col">ECU</th>
            <th scope="col">ECU OUT</th>
            <th scope="col">OUT-TYPE</th>
            <th scope="col">INVERTED</th>
          </tr>
      </thead>
        <tbody>   
         @foreach($actuators as $actuator)
            <tr>
                <div class="row">
                  <td>
                      <div class="item col checkbox-container-fert1">
                      <input type="checkbox" name="{{$actuator->actuatorsId}}" id="{{$actuator->actuatorsId}}">
                      <label class="label" for="{{$actuator->actuatorsId}}">{{$actuator->name}}</label>
                      </div>
                  </td>
                  <td>
                   @if($actuator->actuatorType == 3)       
                      @foreach($turbina as $turbinas)
                        <div class="row">
                              <div class="item col checkbox-container-fert1">
                                <input type="checkbox" name="{{$actuator->actuatorsId}}-{{$turbinas->name}}" id="{{$actuator->actuatorsId}}-{{$turbinas->name}}">
                                <label class="label" for="{{$actuator->actuatorsId}}-{{$turbinas->name}}">{{$turbinas->name}}</label>
                              </div>
                          </div>
                      @endforeach
                    @endif
                    @if($actuator->actuatorType == 5)
                      @foreach($elctrovalvulas as $ev)
                      <div class="row">
                            <div class="item col checkbox-container-fert1">
                              <input type="checkbox" name="{{$actuator->actuatorsId}}-{{$ev->name}}" id="{{$actuator->actuatorsId}}-{{$ev->name}}">
                              <label class="label" for="{{$actuator->actuatorsId}}-{{$ev->name}}">{{$ev->name}}</label>
                            </div>
                        </div>
                      @endforeach
                    @endif
                  </td>
                  <td>
                    @foreach($ecus as $ecu)       
                      <div class="row">
                          <div class="item col checkbox-container-fert1">
                            <input type="checkbox" name="{{$actuator->actuatorsId}}-{{$ecu->ecuId}}" id="{{$actuator->actuatorsId}}-{{$ecu->ecuId}}">
                            <label class="label" for="{{$actuator->actuatorsId}}-{{$ecu->ecuId}}">{{$ecu->name}}</label>
                          </div>
                      </div>
                    @endforeach 
                  </td>
                  <td>
                    @if($ecu->ecu_listId == 4)
                       
                    <div class="product-embrague">
                        <div class="input-group mb-3 mt-4" style="width:130px; height:20px;">
                          <button class="input-group-text decrement-btn">-</button>
                            <input type="text" class="form-control text-center input-qty bg-white" value="0"  id="{{$actuator->actuatorsId}}OUTPUT" name="{{$actuator->actuatorsId}}OUTPUT">
                          <button class="input-group-text increment-btn">+</button>
                        </div>
                      </div>
                    
                    @endif
                    @if($ecu->ecu_listId != 4)
                      <div class="product-seccion">
                        <div class="input-group mb-3 mt-4" style="width:130px; height:20px;">
                          <button class="input-group-text decrement-btn">-</button>
                            <input type="text" class="form-control text-center input-qty bg-white" value="0"  id="{{$actuator->actuatorsId}}OUTPUT" name="{{$actuator->actuatorsId}}OUTPUT">
                          <button class="input-group-text increment-btn">+</button>
                        </div>
                      </div>
                    @endif
                  </td>
                  <td>     
                      <div class="row">
                          <div class="item col checkbox-container-fert1">
                          <input type="checkbox" name="{{$actuator->actuatorsId}}-DIGITAL" id="{{$actuator->actuatorsId}}-DIGITAL">
                          <label class="label" for="{{$actuator->actuatorsId}}-DIGITAL">DIGITAL</label>
                          </div>
                      </div>
                      @if($actuator->actuatorType == 1)
                      <div class="row">
                          <div class="item col checkbox-container-fert1">
                          <input type="checkbox" name="{{$actuator->actuatorsId}}-PUENTE-H" id="{{$actuator->actuatorsId}}-PUENTE-H">
                          <label class="label" for="{{$actuator->actuatorsId}}-PUENTE-H">PUENTE-H</label>
                          </div>
                      </div>
                      @endif
                  </td>
                  <td>
                      <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="{{$actuator->actuatorsId}}-inverted" name="{{$actuator->actuatorsId}}-inverted">
                      </div> 
                  </td>
                  
              </div>
          </tr>
          @endforeach 
      </tbody>
    </table>
    <br/>
    <br/>
    <table id="sensorinput" class="table table-striped table-bordered shadow-lg mt-2" style="width:100%">
    <thead class="bg-success text-white">
          <tr>
            <th scope="col">SENSOR</th>
            <th scope="col">ECU</th>
            <th scope="col">ECU IN</th>
            <th scope="col">ACTUATORS</th>
            <th scope="col">IN TYPE</th>
            <th scope="col">SUBTYPE</th>
            <th scope="col">INVERTED</th>
          </tr>
      </thead>
      <tbody>
             
        @foreach($sensors as $sen)
          <tr>
              <div class="row">
                <td>
                    <div class="item col checkbox-container-fert1">
                    <input type="checkbox" name="S{{$sen->sensorid}}" id="S{{$sen->sensorid}}">
                    <label class="label" for="S{{$sen->sensorid}}">{{$sen->name}}</label>
                    </div>
                </td>
                <td>
                  @foreach($ecus as $ecusssss)       
                    <div class="row">
                        <div class="item col checkbox-container-fert1">
                          <input type="checkbox" name="S{{$sen->sensorid}}-{{$ecusssss->ecuId}}" id="S{{$sen->sensorid}}-{{$ecusssss->ecuId}}">
                          <label class="label" for="S{{$sen->sensorid}}-{{$ecusssss->ecuId}}">{{$ecusssss->name}}</label>
                        </div>
                    </div>
                  @endforeach 
                </td>
                <td>
                  <div class="product-seccion">
                      <div class="input-group mb-3 mt-4" style="width:130px; height:20px;">
                        <button class="input-group-text decrement-btn">-</button>
                          <input type="text" class="form-control text-center input-qty bg-white" value="0"  id="{{$sen->sensorid}}-INPUT" name="{{$sen->sensorid}}-INPUT">
                        <button class="input-group-text increment-btn">+</button>
                      </div>
                    </div>
                </td>
                <td>
                  @foreach($actuators as $actuatorsssx)
                  @if($actuatorsssx->actuatorType == 3)       
                    <div class="row">
                        <div class="item col checkbox-container-fert1">
                        <input type="checkbox" name="{{$sen->sensorid}}-{{$actuatorsssx->actuatorsId}}" id="{{$sen->sensorid}}-{{$actuatorsssx->actuatorsId}}">
                        <label class="label" for="{{$sen->sensorid}}-{{$actuatorsssx->actuatorsId}}">{{$actuatorsssx->name}}</label>
                        </div>
                    </div>
                  @endif
                  @endforeach 
                </td>
                <!--IN TYPE-->
                <td>
                  @foreach($inputtype as $input)       
                    <div class="row">
                        <div class="item col checkbox-container-fert1">
                        <input type="checkbox" name="{{$sen->sensorid}}-INPUTTYPE-{{$input->ordercode}}" id="{{$sen->sensorid}}-INPUTTYPE-{{$input->ordercode}}">
                        <label class="label" for="{{$sen->sensorid}}-INPUTTYPE-{{$input->ordercode}}">{{$input->name}}</label>
                        </div>
                    </div>
                  @endforeach 
                </td>
                <!--SUBTYPE 'subtypespresion','subtypevelo' --> 
                <td>
                  @if($sen->sensorslist_Id == 4)
                    @foreach($subtypespresion as $subpresion)       
                      <div class="row">
                          <div class="item col checkbox-container-fert1">
                          <input type="checkbox" name="{{$sen->sensorid}}-PRESION-{{$subpresion->ordercode}}" id="{{$sen->sensorid}}-PRESION-{{$subpresion->ordercode}}">
                          <label class="label" for="{{$sen->sensorid}}-PRESION-{{$subpresion->ordercode}}">{{$subpresion->name}}</label>
                          </div>
                      </div>
                    @endforeach 
                  @endif
                  @if($sen->sensorslist_Id == 5 )
                    @foreach($subtypevelo as $subevelo)       
                      <div class="row">
                          <div class="item col checkbox-container-fert1">
                          <input type="checkbox" name="{{$sen->sensorid}}-VELOCIDAD-{{$subevelo->ordercode}}" id="{{$sen->sensorid}}-VELOCIDAD-{{$subevelo->ordercode}}">
                          <label class="label" for="{{$sen->sensorid}}-VELOCIDAD-{{$subevelo->ordercode}}">{{$subevelo->name}}</label>
                          </div>
                      </div>
                    @endforeach 
                  @endif
                </td>  
                <td>
                      <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="{{$sen->sensorid}}-inverted" name="{{$sen->sensorid}}-inverted">
                      </div> 
                  </td>            
            </div>
         </tr>
         @endforeach
         
      </tbody>
  </table>
    <br/>
    <div class="d-grid gap-2 d-md-flex me-md-2 btn-guardar">
        <a href="/crucianelli" class="btn btn-warning  me-md-2" tabindex="8">Volver</a>
        <a href="/crucianelli" class="btn btn-danger  me-md-2" tabindex="8"><span class="	far fa-trash-alt"></span></a>
        <button type="submit" class="btn btn-primary me-md-2" value="{{ route('setconfigs')}}" tabindex="9">Siguiente</button>
    </div>
</form>
@stop

@section('css')
<style>
.btn-circle{width: 50px;
  height: 50px;
  padding: 6px 0px;
  text-align: center;
}

.seleccion{
  width: 238px;
  height: 30px;
  text-align: center;   
}

.btn-guardar{
  margin-left: 400px;
  align-items: center;   
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
/* ENTRADAS */
.checkbox-container-ecuin label{
  font-size: 18px;
  width: 35px;
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

.checkbox-container-ecuin input[type="checkbox"]:checked ~ .label{
  border-top: 1px solid red;
	border-left: 1px solid red;
	border-bottom: 1px solid red;
	border-right: 1px solid red;
	background: linear-gradient(45deg, red, red);
	color: white;
}
.checkbox-container-ecuin input[type="checkbox-inline"]:checked ~ .label{
  border-top: 1px solid red;
	border-left: 1px solid red;
	border-bottom: 1px solid red;
	border-right: 1px solid red;
	background: linear-gradient(45deg, red, red);
	color: white;
}

.checkbox-container-ecuin input[type="checkbox"]{
     visibility: hidden;
}
.checkbox-container-ecuin input[type="checkbox-inline"]{
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
/* FERTI */
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
    <script src="{{asset('js\custom.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
@stop
@extends('adminlte::page')
​
@section('title', '')
​
@section('content_header')
    <h2></h2>
@stop
​
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
​
<h1 class="mt-3">Tipos de Siembra</h1>
​
<form action="{{ route('saveSeccion') }}" method="POST">
    @csrf
    <h6>Seleccione adress correspondiente por actuador</h6>
    <br/>
    <table id="ecuoutput" class="table table-striped table-bordered shadow-lg mt-2" style="width:100%">
    <thead class="bg-success text-white">
          <tr>
            <th scope="col">ACTUATOR</th>
            <th scope="col">PRODUCT</th>
            <th scope="col">SECCION</th></br>
            <th scope="col">ROWS</th>
          </tr>
      </thead>
        <tbody>
         @php $primeractuador = 1 @endphp   
         @foreach($actuators as $actuator)
            <tr>
                <div class="row">
                  <td>
                      <div class="item col checkbox-container-fert1">
                      <input type="checkbox" name="ACTUA-{{$actuator->actuatorsId}}" id="ACTUA-{{$actuator->actuatorsId}}">
                      <label class="label" for="ACTUA-{{$actuator->actuatorsId}}">{{$actuator->name}}</label>
                      </div>
                  </td>
                </div>
                <div class="row">
                  <td>
                    @foreach($products as $product)
                       <div class="item col checkbox-container-fert1">
                        <input type="checkbox" name="PROD-{{$actuator->actuatorsId}}-{{$product->productsId}}" id="PROD-{{$actuator->actuatorsId}}-{{$product->productsId}}">
                        <label class="label" for="PROD-{{$actuator->actuatorsId}}-{{$product->productsId}}">{{$product->name}}</label>
                      </div>
                    @endforeach  
                  </td>
                </div>
                <div class="row">
                  <td>
                    @for($i = 1; $i <= $seccion; $i++)
                       <div class="item col checkbox-container-fert1">
                        <input type="checkbox" name="SEC-{{$actuator->actuatorsId}}-{{$i}}" id="SEC-{{$actuator->actuatorsId}}-{{$i}}">
                        <label class="label" for="SEC-{{$actuator->actuatorsId}}-{{$i}}">{{$i}}</label>
                      </div>
                    @endfor
                  </td>
                </div>
                <div class="row">
                <td>
                <!--COLLAPSE BUTTON-->
                <button type="button" class="btn btn-success"  data-bs-target="#collapse{{$actuator->actuatorsId}}" data-bs-toggle="collapse" aria-controls="collapse{{$actuator->actuatorsId}}" aria-expanded="false">
                  Surcos
                </button>

              <div class="collapse" id="collapse{{$actuator->actuatorsId}}">
                <div class="modal-body">
                    @csrf                
                          <table>
                            <thead class="bg-success text-white">
                              <tr>
                                @for($x = 1; $x <= $rows; $x++)
                                <th scope="col">S{{$x}}</th>
                                @endfor 
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                @for($i = 1; $i <= $rows; $i++)
                                <td>
                                  <div class="checkbox-container-rows">
                                    <input type="checkbox" class="{{$actuator->actuatorsId}}rows"  name="SURCO<?=$primeractuador.$i?>" id="SURCO<?=$primeractuador.$i?>">
                                    <label class="label-checkbox-container-rows" for="SURCO<?=$primeractuador.$i?>">S<?=$i?></label>
                                  </div>
                                </td>
                                @endfor 
                                @php $primeractuador = $primeractuador + 1 @endphp
                              </tr>
                            </tbody>
                          </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="checkbox-container-todos">
                            <input type="checkbox" class="select-todos" name="TODOS" id="TODOS" />
                            <label class="label-checkbox-container-todos" for="TODOS">Seleccionar Todos</label>
                        </div>
                        <div class="checkbox-container-par">
                            <input type="checkbox" class="select-par" onclick="mandarId(this.id,this.$row)" name="par" id="par" />
                            <label class="label-checkbox-container-par" for="par">Seleccion Par</label>
                        </div>
                        <div class="checkbox-container-impar">
                            <input type="checkbox" class="select-impar" name="impar" id="impar" />
                            <label class="label-checkbox-container-impar" for="impar">Seleccion Impar</label>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <!--FIN DEL MODAL-->
                  </div>
              </td>
            </tr>
        @endforeach 
      </tbody>
    </table>
    <hr/>
    <button type="submit" class="btn btn-success" value="{{ route('saveSeccion') }}">Save changes</button>
</form>
@stop
​
​
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@stop
​
@section('js')
    <script src="{{asset('js\custom.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@stop
@extends('layouts.horizontal2')
@section('title','Buscador')
@section('routes')
<li class="breadcrumb-item active">Buscador</li>
@endsection
@section('css')
<link href="{{asset('material-pro/assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<style media="screen">
   .middle{
      margin-left: auto;
      margin-right: auto;
      text-align: center;
   }
   .centered{
      padding-left: auto;
      padding-right: auto;
      text-align: center;
   }
   .choose{
      display: inline-block;
      vertical-align: text-top;
   }
   .choose-form{
      margin-top: 7px;
   }
   .hidden{
      display: none;
   }
   .form-tittle{
      display: inline-block;
      position: inherit;
      top: -15px;
      padding-bottom: 10px;
      padding: 0 5px;
      font-weight: bold;
      font-size: 1.2em;
      background-color: white;
   }
   .group-form{
      min-height: 210px;
      margin-top: 15px;
      border: 2px solid gray;
      margin-right: 30px;
   }
   .none{
      display: none;
   }
</style>
@endsection
@section('content')
{{-- Buscador --}}
<div class="card">
   <div class="choose-form centered">
      <div class="choose col-md-2">
         <input name="choose-form" type="radio" id="choose-basic" class="radio-col-yellow" onchange="changeTab(1)" checked>
         <label for="choose-basic">Básico</label>
      </div>
      <div class="choose col-md-2">
         <input name="choose-form" type="radio" id="chooce-intermediate" class="radio-col-orange" onchange="changeTab(2)">
         <label for="chooce-intermediate">Intermedio</label>
      </div>
      <div class="choose col-md-2">
         <input name="choose-form" type="radio" id="choose-advanced" class="radio-col-red" onchange="changeTab(3)">
         <label for="choose-advanced">Avanzado</label>
      </div>
   </div>
   <div class="card-body">
      <div id="BasicSearch" style="text-align: center;"> <!-- BASIC SEARCH -->
         <div class="form-group col-md-6 middle">
            <input type="text" class="form-control form-control-line" placeholder="Buscar por palabra clave" name="b-keyword">
         </div>
         <div class="middle">
            <button type="submit" class="btn btn-success waves-effect waves-light mr-2" onclick="formBasic()">Buscar</button>
         </div>
      </div>
      <div id="IntermediateSearch" class="none" style="text-align: center;"> <!-- INTERMEDIATE SEARCH -->
         <div class="form-group col-md-6 middle">
            <input type="text" class="form-control form-control-line" placeholder="Buscar por palabra clave" name="i-keyword">
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- date -->
            <span class="form-tittle">Fecha de sustentación </span>
            <div class="form-group">
               <i class="far fa-calendar-alt"></i>
               <label for="i-date-from">Desde: </label>
               <input class="col-md-7" type="date" id="i-date-from" name="i-exposition-from_date">
            </div>
            <div class="form-group">
               <i class="far fa-calendar-alt"></i>
               <label for="i-date-to">Hasta: </label>
               <input class="col-md-7" type="date" id="i-date-to" name="i-exposition-to_date">
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- author -->
            <span class="form-tittle">Autor </span>
            <div class="form-group">
              <select id="i-select_author" class="select2" name="i-author-dni" style="width: 100%">
                 @foreach($autores as $a) <option value="{{$a->dni}}">{{$a->datos}}</option> @endforeach
              </select>
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- program -->
            <span class="form-tittle">Programa </span>
            <div class="form-group">
               <select name="i-program-faculty" class="custom-select col-11 set_programa_2" id="facultad_2"> <!-- faculty -->
                  <option value="">- Facultad -</option>
                  @foreach($facultades as $i=>$v) <option value="{{$i}}">{{$v}}</option> @endforeach
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="i-program-type" class="custom-select col-11 set_programa_2" id="escuela_2"> <!-- level -->
                  <option value="">- Nivel academico -</option>
                  @foreach($attr['tipo_programa'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="i-program-school" class="custom-select col-11" id="programa_academico_2"> <!-- school -->
                  <option value="">- Escuela -</option>
                  @foreach($escuela as $i=>$v) <option value="{{$i}}">{{$v}}</option> @endforeach
               </select>
            </div>
         </div>
         <div class="middle"> <!-- submit -->
            <button type="submit" class="btn btn-success waves-effect waves-light mr-2" onclick="formIntermediate()">Buscar</button>
         </div>
      </div>
      <div id="AdvancedSearch" class="none" style="text-align: center;"> <!-- ADVANCED SEARCH -->
         <div class="form-group col-md-6 middle"> <!-- keyword -->
            <input type="text" class="form-control form-control-line" placeholder="Buscar por palabra clave" name="a-keyword">
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- exposition -->
            <span class="form-tittle">Fecha de sustentación </span>
            <div class="form-group">
               <i class="far fa-calendar-alt"></i>
               <label for="a-date-from">Desde: </label>
               <input name="a-exposition-from_date" class="col-md-7" type="date" id="a-date-from">
            </div>
            <div class="form-group">
               <i class="far fa-calendar-alt"></i>
               <label for="a-date-to">Hasta: </label>
               <input name="a-exposition-to_date" class="col-md-7" type="date" id="a-date-to">
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- author -->
            <span class="form-tittle">Autor </span>
            <div class="form-group">
              <select id="a-select_author" class="select2" name="a-author-dni" style="width: 100%">
                 @foreach($autores as $a) <option value="{{$a->dni}}">{{$a->datos.' - '.$a->dni}}</option> @endforeach
              </select>
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- program -->
            <span class="form-tittle">Programa </span>
            <div class="form-group">
               <select name="a-program-faculty" class="custom-select col-11 set_programa_3" id="facultad_3"> <!-- faculty -->
                  <option value="">- Facultad -</option>
                  @foreach($facultades as $i=>$v) <option value="{{$i}}">{{$v}}</option> @endforeach
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="a-program-type" class="custom-select col-11 set_programa_3" id="escuela_3"> <!-- type -->
                  <option value="">- Programa -</option>
                  @foreach($attr['tipo_programa'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="a-program-school" class="custom-select col-11" id="programa_academico_3"> <!-- school -->
                  <option value="">- Escuela -</option>
                  @foreach($escuela as $i=>$v) <option value="{{$i}}">{{$v}}</option> @endforeach
               </select>
            </div>
         </div>
         <div class="form-group col-md-9 choose group-form"> <!-- research -->
            <span class="form-tittle">Investigación </span>
            <div class="form-group">
               <select name="a-research-line" class="custom-select col-3"> <!-- line -->
                  <option value="">- Linea -</option>
                  @foreach($attr['linea_general'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                  @foreach($attr['linea_fisica'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
                  @foreach($attr['linea_enfermeria'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-1" style="display: inline-block;">&nbsp;</span>
               <select name="a-research-nature" class="custom-select col-3"> <!-- nature -->
                  <option value="">- Naturaleza -</option>
                  @foreach($attr['naturaleza'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-1" style="display: inline-block;">&nbsp;</span>
               <select name="a-research-approach" class="custom-select col-3"> <!-- approach -->
                  <option value="">- Enfoque -</option>
                  @foreach($attr['enfoque'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="a-research-cut" class="custom-select col-3"> <!-- cut -->
                  <option value="">- Corte -</option>
                  @foreach($attr['corte'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-1" style="display: inline-block;">&nbsp;</span>
               <select name="a-research-temporality" class="custom-select col-3"> <!-- temporality -->
                  <option value="">- Temporalidad -</option>
                  @foreach($attr['temporalidad'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-1" style="display: inline-block;">&nbsp;</span>
               <select name="a-research-design" class="custom-select col-3"> <!-- design -->
                  <option value="">- Diseño -</option>
                  @foreach($attr['diseno'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="a-research-level" class="custom-select col-3"> <!-- level -->
                  <option value="">- Nivel -</option>
                  @foreach($attr['nivel'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-1" style="display: inline-block;">&nbsp;</span>
               <select name="a-research-population" class="custom-select col-3"> <!-- population -->
                  <option value="">- Población -</option>
                  @foreach($attr['poblacion'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
               <span class="col-1" style="display: inline-block;">&nbsp;</span>
               <select name="a-research-sample" class="custom-select col-3"> <!-- sample -->
                  <option value="">- Muestra -</option>
                  @foreach($attr['muestra'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
            </div>
         </div>
         <div class="form-group col-md-9 choose group-form"> <!-- analysis unity -->
            <span class="form-tittle">Unidad de análisis </span>
            <div class="form-group">
               @foreach($attr['unidad_analisis'] as $k=>$v)
                  @if($k%3==0)
                     <span class="col-12" style="display: inline-block;">&nbsp;</span>
                  @else
                     <span class="col-1" style="display: inline-block;">&nbsp;</span>
                  @endif
                  <input name="a-analysis_unity-{{$k}}" id="a-au-{{$k}}" type="checkbox" class="filled-in chk-col-grey" value="{{$v->id}}">
                  <label for="a-au-{{$k}}" class="checkbox col-md-3" style="vertical-align: middle; text-align: left;">{{$v->descripcion}}</label>
               @endforeach
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- budget -->
            <span class="form-tittle">Financiamiento </span>
            <div class="form-group">
               <select name="a-budget-min" class="custom-select col-11">
                  <option value="">Desde</option>
                  @for($i=2; $i<=5; $i++)
                  <option value="{{str_pad(1,$i,'0')}}">{{str_pad(1,$i,'0')}}</option>
                  <option value="{{str_pad(5,$i,'0')}}">{{str_pad(5,$i,'0')}}</option>
                  @endfor
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="a-budget-max" class="custom-select col-11">
                  <option value="">Hasta</option>
                  @for($i=2; $i<=5; $i++)
                  <option value="{{str_pad(1,$i,'0')}}">{{str_pad(1,$i,'0')}}</option>
                  <option value="{{str_pad(5,$i,'0')}}">{{str_pad(5,$i,'0')}}</option>
                  @endfor
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="a-budget-financed" class="custom-select col-11">
                  <option value="">Financiado por</option>
                  @foreach($attr['fuente_financiamiento'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- lugar -->
            <span class="form-tittle">Lugar </span>
            <div class="form-group">
               <select id="ubigeo" name="a-place" class="custom-select col-11 select2" placeholder="'Distrio - Provincia - Departamento'"> <!-- place -->
                  <option value="">Distrio - Provincia - Departamento</option>
                  @foreach($ubigeo as $i=>$v) <option value="{{$i}}">{{$v}}</option> @endforeach
               </select>
               <span class="col-12" style="display: inline-block;">&nbsp;</span>
               <select name="a-area" class="custom-select col-11"> <!-- area -->
                  <option value="">Area</option>
                  @foreach($attr['area_estudio'] as $v) <option value="{{$v->id}}">{{$v->descripcion}}</option> @endforeach
               </select>
            </div>
         </div>
         <div class="middle"> <!-- submit -->
            <button type="submit" class="btn btn-success waves-effect waves-light mr-2" onclick="formAdvanced()">Buscar</button>
         </div>
      </div>
   </div> <!-- END FORMS -->
</div>
{{-- Resultados --}}
<div class="card" id="body_result" style="display: none;">
   <div id="resultados" class="card-body">
      <i>Aquí se mostrarán los resultados</i>
   </div>
</div>
@endsection
@section('js')
<script src="{{asset('material-pro/assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/buscador.js')}}"></script>
@endsection

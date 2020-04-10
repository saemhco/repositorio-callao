@extends('layouts.horizontal2')

@section('css')
<link href="{{asset('material-pro/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{asset('material-pro/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css')}}" id="theme" rel="stylesheet">
<link href="{{asset('material-pro/assets/plugins/wizard/steps.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet"href="{{asset('material-pro/assets/plugins/html5-editor/bootstrap-wysihtml5.css')}}" />
<link href="{{asset('material-pro/assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('material-pro/assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('title','Buscador')
@section('routes')
<li class="breadcrumb-item">Buscador</li>
<li class="breadcrumb-item active">Resultado</li>
@endsection
@section('content')
<div class="card">
   <div class="card-body">
      <h3 class="card-title">{{ $informe->titulo}}</h3><hr>
      <div class="row">
      	<div class="col-md-3">
      		<span style="background-color: rgb(0, 0, 0,0.5); color: white;position:absolute; z-index: 2; padding: 1px;">
      		{{ $informe->programa->padre->descripcion }}<br>
      		{{ $informe->programa->descripcion }}</span>
      		<div data-icon="&#xe012;" class="linea-icon linea-basic" style="font-size: 150px; margin-top: 25px; text-align: center">
      			<h3 style="margin-top: -60px;">{{strtoupper($informe->nivel_acad->descripcion)}}</h3>
      		</div><hr>
      		@foreach($personas as $p)
      		@if(in_array($informe->personas()->whereIn('condicion_id',$p['condiciones'])->pluck('condicion_id')->first(), $p['condiciones']))
      			<small class="text-muted">{{ $p['titulo']}}</small>
      		@endif
      		<h6>
      			<ul>
      				@foreach($informe->personas()->whereIn('condicion_id',$p['condiciones'])->get() as $pivot)
      				<li>
      					{{ App\Autor::where('informe_id',$pivot->pivot->informe_id)
      								 ->where('persona_id',$pivot->pivot->persona_id)
      								 ->where('condicion_id',$pivot->pivot->condicion_id)
      								 ->first()->condicion->descripcion}}:<br>
      					{{ $pivot->nombres.' '.$pivot->apellidos }}
      				</li>
      				@endforeach
      			</ul>
      		</h6>
			@endforeach
      		<br>
      		<small class="text-muted">Facultad</small><h6>{{ $informe->programa->padre->descripcion }}</h6>
      		<small class="text-muted">Nivel Académico</small><h6>{{ $informe->nivel_acad->descripcion }}</h6>
      		<small class="text-muted">Programa</small><h6>{{ $informe->programa->descripcion }}</h6>
      		<br>
      		<small class="text-muted">Fecha de sustentación</small><h6>2016-09-10</h6>
      		<small class="text-muted">Cronograma - inicio</small><h6>2014-09-10</h6>
      		<small class="text-muted">Cronograma - fin</small><h6>2015-09-10</h6>
			<br>
			@if($informe->url)
      		<small class="text-muted">URL Callao</small><h6><a href="{{$informe->url}}" target="_blank">{{ $informe->url }}</a></h6>
      		@endif
      		@if($informe->file)
      		<small class="text-muted">Documento</small><h6><a href="{{ Storage::url($informe->file)}}" target="_blank">Descargar aquí</a></h6>
      		@endif
      	</div>
      	<div class="col-md-9">
      		@if(Auth::user())
      		<div class="row">
      			<div class="col-md-6">
      			<small class="text-muted"><b>Registrado por</b></small><h6 style="text-align: justify;">{!! $informe->registrado_por() !!}</h6>
      			</div>
      			<div class="col-md-6">
      			<small class="text-muted"><b>Actualizado por</b></small><h6 style="text-align: justify;">{!! $informe->actualizado_por() !!}</h6>
      			</div>
      		</div>
      		@endif
      		<small class="text-muted"><b>Resumen</b></small><br><label style="text-align: justify;">{!! $informe->resumen !!}</label><br>
      		<small class="text-muted"><b>Objetivos</b></small><br><label style="text-align: justify;">{!! $informe->objetivos !!}</label><br>
      		<div class="row">
      			<div class="col-md-3">
      				<small class="text-muted"><b>Modalidad</b></small><h6>{!! $informe->modalidad->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Linea de investigación UNAC</b></small><h6>{!! $informe->linea->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Prioridad nacional de salud</b></small><h6>{!! $informe->prioridad->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Producto</b></small>
      				<h6>{!! $informe->producto->descripcion !!}@if($informe->producto->descripcion=='Otros'): {{$informe->producto_otro }}@endif</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Naturaleza</b></small><h6>{!! $informe->naturaleza->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Enfoque</b></small><h6>{!! $informe->enfoque->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Corte</b></small><h6>{!! $informe->corte->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Temporalidad</b></small><h6>{!! $informe->temporalidad->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Diseño</b></small><h6>{!! $informe->diseno->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Nivel</b></small><h6>{!! $informe->nivel->descripcion !!}</h6>
      			</div>
      			<div class="col-md-6">
      				<small class="text-muted"><b>Lugar de estudio (Distrito - Provincia - Departamento)</b></small>
      				<h6>{{$informe->ubigeo->descripcion}} - {{$informe->ubigeo->provincia->descripcion}} - {{$informe->ubigeo->departamento->descripcion}}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Población</b></small><h6>{!! $informe->poblacion->descripcion !!}</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Muestra</b></small><h6>{!! $informe->muestra->descripcion !!}</h6>
      			</div>
      			<div class="col-md-2">
      				<small class="text-muted"><b>Presupuesto (S/)</b></small><h6>{!! $informe->presupuesto !!}</h6>
      			</div>
      			<div class="col-md-4">
      				<small class="text-muted"><b>Fuente de financiamiento</b></small>
      				<h6>{{$informe->fuente_financiamiento->descripcion}}@if($informe->fuente_financiamiento->descripcion=='Otro'): {{$informe->fuente_financiamiento_otro }}@endif</h6>
      			</div>
      			<div class="col-md-3">
      				<small class="text-muted"><b>Área de estudio</b></small>
      				<h6>{!! $informe->area_estudio->descripcion !!}@if($informe->area_estudio->descripcion=='Otros'): {{$informe->area_estudio_otro }}@endif</h6>
      			</div>
      			<div class="col-md-12">
      				<small class="text-muted"><b>Unidad de análisis</b></small>
      			</div>
      			<div class="col-md-12">
		             <div class="form-group demo-checkbox">
		                @foreach($attr['unidad_analisis'] as $k=>$v)
		                @if(in_array($v->id , $informe->unidad_analisis_explode() ))
						<input id="c-ua-{{$k}}" type="checkbox" class="filled-in chk-col-light-blue " value="{{$v->id}}" disabled="false" checked="true">
		                <label for="c-ua-{{$k}}" class="checkbox col-md-3" style="vertical-align: middle; text-align: left;">
		                	{{$v->descripcion}}@if($v->descripcion=='Otros'): {{$informe->unidad_analisis_otro }}@endif
		                </label>
		            	@endif
		                @endforeach
		             </div>

		             <div class="form-group col-md-12" id="otro_unidad" style="display: none;">
		                <input type="text" class="form-control" name="otro_unidad">
		                <span class="bar"></span>
		                <label for="otro_unidad">Mencione otros</label>
		             </div>
	            </div>
      		</div>




      	</div>
      </div>
   </div>
</div>
@endsection
@section('js')
<!-- This is data table -->
<script src="{{ asset('material-pro/assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('material-pro/assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
{{-- Wizard --}}
<script src="{{asset('material-pro/assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/wizard/jquery.steps.min.js')}}"></script>

<script src="{{asset('material-pro/assets/plugins/wizard/jquery.validate.min.js')}}"></script>
<!-- wysuhtml5 Plugin JavaScript -->
<script src="{{asset('material-pro/assets/plugins/html5-editor/wysihtml5-0.3.0.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/html5-editor/bootstrap-wysihtml5.js')}}"></script>
{{-- Select2 --}}
<script src="{{asset('material-pro/assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
{{-- SweetAlert --}}
<script src="{{asset('material-pro/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('js/sweetalert2.all.min.js')}}"></script>
{{-- Ajustes de vista --}}
{{-- <script src="{{asset('js/informe.js')}}"></script> --}}
@endsection

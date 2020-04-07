@extends('layouts.horizontal2')

@section('css')
<link href="{{asset('material-pro/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{asset('material-pro/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css')}}" id="theme" rel="stylesheet">
<link href="{{asset('material-pro/assets/plugins/wizard/steps.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet"href="{{asset('material-pro/assets/plugins/html5-editor/bootstrap-wysihtml5.css')}}" />
<link href="{{asset('material-pro/assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('material-pro/assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('title','Personas')
@section('routes')
<li class="breadcrumb-item active">Personas</li>
<li class="breadcrumb-item active">Investigación (personas)</li>
@endsection
@section('content')
<div class="card">
   <div class="card-body">
   @include('personas.persona.nuevo')
   @include('personas.persona.editar')
   <div class="row">
      <div class="col-6" align="left">
      <h4 class="card-title">
        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" data-toggle="modal" data-target="#modal_nuevo">
           <i class="fa fa-plus"></i> Nuevo
        </button>
      </h4>
      </div>
      <div class="btn-group col-6" align="right" style="display: block; ">      
         <h4 class="card-title"  align="right">
            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
              <i class="far fa-file-excel"></i> Carga masiva 
              <i class="mdi mdi-menu-down-outline"></i>
            </button>
           <div class="dropdown-menu dropdown-menu-sm-right">
              <label class="dropdown-item" type="button" for="importar-usuarios">Cargar archivo</label>
              <input id="importar-usuarios" onChange="importar()" type="file" style='display: none;' accept=".xlsx"/>
              <a class="dropdown-item" href="{{ url('files/plantilla/personas.xlsx') }}" target="_blank">Descargar plantilla</a>
           </div>
         </h4>
       </div>
   </div>

      <div class="table-responsive mt-4">
         <table id="datatable-ajax" class="table display table-bordered table-striped">
            <thead>
               <tr>
                  <th>DNI</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Género</th>
                  <th style="text-align: center;">Acciones</th>
               </tr>
            </thead>
            <tbody>
            </tbody>
         </table>
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
<script src="{{asset('js/persona.js')}}"></script>
@endsection

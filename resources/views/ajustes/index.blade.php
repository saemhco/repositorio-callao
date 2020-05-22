@extends('layouts.horizontal2')

@section('css')
<link href="{{asset('material-pro/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{asset('material-pro/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css')}}" id="theme" rel="stylesheet">
<link href="{{asset('material-pro/assets/plugins/wizard/steps.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet"href="{{asset('material-pro/assets/plugins/html5-editor/bootstrap-wysihtml5.css')}}" />
<link href="{{asset('material-pro/assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('material-pro/assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('title','Ajustes')
@section('routes')
<li class="breadcrumb-item active">Ajustes</li>
@endsection
@section('content')
<div class="card">
   <div class="card-body">
      <form method="POST" action="{{ route('ajustes.update') }}" enctype="multipart/form-data">
                        @csrf
      <div class="row">
      <div class="col-sm-6">
         <button type="submit" class="btn btn-success">Guardar cambios</button>
      </div>
      <div class="col-sm-6" align="right">
         <a href="{{ route('ajustes.restablecer')}}" onclick="return confirmacion_eliminar()">restablecer</a>
      </div>
            
      <div class="col-12"><hr><br></div>
      @foreach($ajustes as $a)
         
         <div class="col-md-4">
            <h3>{{ $a->nombre}}</h3>
            <label>{{ $a->descripcion }}</label>
         </div>
         <div class="col-md-8">
            @switch($a->tipo)
               @case('texto') <input type="text" name="elemento_{{$a->id}}" class="form-control" value="{{ $a->valor }}" required> @break
               @case('imagen') 
               <?php $ruta_img='';
                  if(substr($a->valor, 0,6)=='public') $ruta_img=Storage::url($a->valor);
                  else $ruta_img= $a->valor;
                  list($ancho, $alto, $type, $attr)=getimagesize(substr($a->valor, 0,6)=='public'?substr(Storage::url($a->valor),1):$a->valor);
               ?>
                  <div>
                     <img src="{{substr($a->valor, 0,6)=='public'?Storage::url($a->valor):$a->valor}}" style="max-width: 500px;" 
                     width="{{$a->id>5?'100%':'10%'}}">
                     <br><label><small>{{$attr}}</small></label>
                  </div>
                  <input type="file" name="elemento_{{$a->id}}" accept="image/*">
                  
                @break
               @case('archivo_ruta') <input type="url" name="elemento_{{$a->id}}" value="{{ $a->valor }}" class="form-control" required>
                  <a href="{{ url($a->valor) }}" target="_blank">Abrir el enlace</a> @break
               @default <span>Valor no reconocido</span> @break
            @endswitch
         </div>
         <div class="col-12"><hr><br></div>
      @endforeach  
      </div>
      <button type="submit" class="btn btn-success">Guardar cambios</button>
      </form>
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
<script type="text/javascript">
   function confirmacion_eliminar() {
     return confirm('Los datos se eliminarán permanentemete y se restablecerán');
   }
</script>
{{-- Ajustes de vista --}}
@endsection

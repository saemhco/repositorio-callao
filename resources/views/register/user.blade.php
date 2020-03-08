@extends('layouts.horizontal2')
@section('title','Registro Usuario')
@section('routes')
<li class="breadcrumb-item active">Registrar</li>
<li class="breadcrumb-item active">Usuario</li>
@endsection
@section('css')
<style media="screen">
   .middle{
      margin-left: auto;
      margin-right: auto;
   }
</style>
@endsection
@section('content')
<div class="col-lg-6 col-md-12 middle">
   <div class="card card-body">
      <h3 class="mb-0">Registrar usuario</h3>
      <span class="col-12" style="display: inline-block;">&nbsp;</span>
      <div class="row">
         <div class="col-sm-12 col-xs-12" id="UserRegister">
            <div class="form-group">
               <label for="user-nombres">Nombres</label>
               <input type="text" class="form-control" name="user-nombres" placeholder="Nombres">
            </div>
            <div class="form-group">
               <label for="user-apellidos">Apellidos</label>
               <input type="email" class="form-control" name="user-apellidos" placeholder="Apellidos">
            </div>
            <div class="form-group">
               <label for="user-dni">DNI</label>
               <input type="text" class="form-control" name="user-dni" placeholder="DNI" maxlength="8">
            </div>
            <div class="form-group">
               <label for="user-codigo">Código</label>
               <input type="text" class="form-control" name="user-codigo" placeholder="Código" maxlength="11">
            </div>
            <div class="form-group">
               <label for="user-genero-m">Genero</label> <br>
               <input name="user-genero" type="radio" id="user-genero-m" class="with-gap radio-col-red" value="M" checked>
               <label for="user-genero-m">Masculino</label>
               <input name="user-genero" type="radio" id="user-genero-f" class="with-gap radio-col-red" value="F">
               <label for="user-genero-f">Femenino</label>
            </div>
            <div style="text-align: right;">
               <button class="btn btn-success waves-effect waves-light mr-2" onclick="saveUser()">Guardar</button>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
   function saveUser(){
      let data = {};  // Data storage
      document.querySelectorAll("div#UserRegister input").forEach((v)=>{  // INPUT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         value = v.value;
         _struct = v.name.split("-").slice(1);
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               /* FIX RADIO INPUTS */
               if(v.type=="radio") if(!v.checked) return;  // Skip this element because it's a radio unchecked
               /* FIX CHECKBOX INPUTS */
               if(v.type=="checkbox") if(!v.checked) return; // Skip if this element is checkbox and it's unchecked
               /* FIX EMPTY INPUTS */
               if(v.value=="") return;  // Skip if value is empty
               data[_struct[0]] = value; // ADD VALUE
               break;
            case 2:  // ARRAY PARAM
               /* FIX RADIO INPUTS */
               if(v.type=="radio") if(!v.checked) return;  // Skip this element because it's a radio unchecked
               /* FIX CHECKBOX INPUTS */
               if(v.type=="checkbox") if(!v.checked) return; // Skip if this element is checkbox and it's unchecked
               /* FIX EMPTY INPUTS */
               if(value=="") return;  // Skip if value is empty
               /* FIX NESTED OBJECT */
               if(!data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]] = {}  // Initialize as empty object
               }
               data[_struct[0]][_struct[1]] = value;  // Set value
               break;
            default: return false;
         }
      });

      console.log("Data: ", data);
      if(Object.entries(data).length==0) return;  // Skip if object is empty
      $.ajax({
         type: 'POST',
         url: '{{ route("register.user") }}',
         data: {
            _token: "{{ csrf_token() }}",
            data: data,
         },
         success: (e) => {
            console.log(e)
         },
         error: (e) => {
            console.log(e)
         }
      });
   }
</script>
@endsection

@extends('layouts.horizontal2')
@section('title','Buscador')
@section('routes')
<li class="breadcrumb-item active">Buscador</li>
@endsection
@section('css')
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
      margin-top: 15px;
      border: 2px solid gray;
      margin-right: 30px;
   }
</style>
@endsection
@section('content')
{{-- Buscador --}}
<div class="card">
   <div class="choose-form centered">
      <div class="choose col-md-2">
         <input name="choose-form" type="radio" id="choose-basic" class="radio-col-yellow" checked>
         <label for="choose-basic">Básico</label>
      </div>
      <div class="choose col-md-2">
         <input name="choose-form" type="radio" id="chooce-intermediate" class="radio-col-orange">
         <label for="chooce-intermediate">Intermedio</label>
      </div>
      <div class="choose col-md-2">
         <input name="choose-form" type="radio" id="choose-advanced" class="radio-col-red">
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
      <hr>
      <div id="IntermediateSearch" style="text-align: center;"> <!-- INTERMEDIATE SEARCH -->
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
               <input type="text" class="form-control form-control-line" placeholder="DNI - Apellidos Nombres" name="i-author-dni">
            </div>
            <div class="form-group">
               <input name="i-author-genre" type="radio" id="i-genre-m" class="with-gap radio-col-red" value="M" checked>
               <label for="i-genre-m">Masculino</label>
               <input name="i-author-genre" type="radio" id="i-genre-f" class="with-gap radio-col-red" value="F">
               <label for="i-genre-f">Femenino</label>
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- program -->
            <span class="form-tittle">Programa </span>
            <div class="form-group">
               <select name="i-program-faculty" class="custom-select col-11">
                  <option selected="">Facultad</option> <!-- faculty -->
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>
               <span class="col-1" style="display: block;">&nbsp;</span> <!-- nothing, just a blank space -->
               <select name="i-program-school" class="custom-select col-11"> <!-- school -->
                  <option selected="">Escuela</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>
               <span class="col-1" style="display: block;">&nbsp;</span> <!-- nothing, just a blank space -->
               <select name="i-program-type" class="custom-select col-11"> <!-- type -->
                  <option selected="">Programa</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>
            </div>
         </div>
         <div class="middle">
            <button type="submit" class="btn btn-success waves-effect waves-light mr-2" onclick="formIntermediate()">Buscar</button>
         </div>
      </div>
      <hr>
      <div id="AdvancedSearch" style="text-align: center;"> <!-- ADVANCED SEARCH -->
         <div class="form-group col-md-6 middle">
            <input type="text" class="form-control form-control-line" placeholder="Buscar por palabra clave" name="a-keyword">
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- date -->
            <span class="form-tittle">Fecha de sustentación </span>
            <div class="form-group">
               <i class="far fa-calendar-alt"></i>
               <label for="a-date-from">Desde: </label>
               <input class="col-md-7" type="date" id="a-date-from" name="a-exposition-from_date">
            </div>
            <div class="form-group">
               <i class="far fa-calendar-alt"></i>
               <label for="a-date-to">Hasta: </label>
               <input class="col-md-7" type="date" id="a-date-to" name="a-exposition-to_date">
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- author -->
            <span class="form-tittle">Autor </span>
            <div class="form-group">
               <input name="a-author-dni" type="text" class="form-control form-control-line" placeholder="DNI - Apellidos Nombres">
            </div>
            <div class="form-group">
               <input name="a-author-genre" type="radio" id="a-genre-m" class="with-gap radio-col-red" value="M" checked>
               <label for="a-genre-m">Masculino</label>
               <input name="a-author-genre" type="radio" id="a-genre-f" class="with-gap radio-col-red" value="F">
               <label for="a-genre-f">Femenino</label>
            </div>
         </div>
         <div class="form-group col-md-3 choose group-form"> <!-- program -->
            <span class="form-tittle">Programa </span>
            <div class="form-group">
               <select name="a-program-faculty" class="custom-select col-11">
                  <option selected="">Facultad</option> <!-- faculty -->
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>
               <span class="col-1" style="display: block;">&nbsp;</span> <!-- nothing, just a blank space -->
               <select name="a-program-school" class="custom-select col-11"> <!-- school -->
                  <option selected="">Escuela</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>
               <span class="col-1" style="display: block;">&nbsp;</span> <!-- nothing, just a blank space -->
               <select name="a-program-program" class="custom-select col-11"> <!-- type -->
                  <option selected="">Programa</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
               </select>
            </div>
         </div>
         <div class="middle">
            <button type="submit" class="btn btn-success waves-effect waves-light mr-2" onclick="formAdvanced()">Buscar</button>
         </div>
      </div>
   </div> <!-- END FORMS -->
</div>
{{-- Resultados --}}
<div class="card">
   <div class="card-body">
      //vista de los resultados
   </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
   function formBasic(){
      console.log("BASIC FORM")
      let data = {};  // Data storage
      document.querySelectorAll("div#BasicSearch input").forEach((v)=>{  // INPUT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         name = v.name.slice(2);  // Take off search level
         value = v.value;
         _struct = name.split("-");
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               data[_struct[0]] = value;
               break;
            case 2:  // ARRAY PARAM
               if(data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }else{  // If data doesn't has this property
                  data[_struct[0]] = {}  // Initialize as empty object
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }
               break;
            default: return false;
         }
      });
      console.log("Data: ", data);
      $.ajax({
         type: 'POST',
         url: '{{ route("search.basic") }}',
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
   function formIntermediate(){
      console.log("INTERMEDIATE FORM")
      /*
      data = {
         keyword: 'something to search for',
         exposition: {
            from_date: '',
            to_date: ''
         },
         author: {
            dni: ''
         },
         program: {
            faculty: '',
            school: '',
            type: ''
         }
      } */
      let data = {};  // Data storage
      document.querySelectorAll("div#IntermediateSearch input").forEach((v)=>{  // INPUT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         name = v.name.slice(2);  // Take off search level
         value = v.value;
         _struct = name.split("-");
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               /* FIX RADIO INPUTS */
               if(v.type=="radio") if(!v.checked) return;  // Skip this element because it's a radio unchecked

               data[_struct[0]] = value;
               break;
            case 2:  // ARRAY PARAM
               /* FIX RADIO INPUTS */
               if(v.type=="radio") if(!v.checked) return;  // Skip this element because it's a radio unchecked

               if(data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }else{  // If data doesn't has this property
                  data[_struct[0]] = {}  // Initialize as empty object
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }
               break;
            default: return false;
         }
      });
      document.querySelectorAll("div#IntermediateSearch select").forEach((v)=>{  // SELECT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         name = v.name.slice(2);  // Take off search level
         value = v.value;
         _struct = name.split("-");
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               data[_struct[0]] = value;
               break;
            case 2:  // ARRAY PARAM
               if(data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }else{  // If data doesn't has this property
                  data[_struct[0]] = {}  // Initialize as empty object
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }
               break;
            default: return false;
         }
      });
      // Fix Radio inputs

      console.log("Data: ", data);
      $.ajax({
         type: 'POST',
         url: '{{ route("search.intermediate") }}',
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
   function formAdvanced(){
      console.log("ADVANCED FORM")
      /* Values are Attribute's id
      data = {
         keyword: 'something to search for',
         product: '',
         exposition: {
            from_date: '',
            to_date: ''
         },
         budget: {
            min: '',
            max: '',
            financed: ''  // OTHER
         },
         author: {
            dni: '',
            condition: ''
         },
         program: {
            faculty: '',
            school: '',
            type: ''
         },
         research: {
            line: '',
            nature: '',
            approach: '',
            cut: '',
            temporality: '',
            design: '',
            level: '',
            population: '',  // OTHER
            sample: '',  // OTHER
         },
         analysis_unity: ['', ''],  // OTHER
         place: '',
         area: ''  // OTHER
      }; */
      let data = {};  // Data storage
      document.querySelectorAll("div#AdvancedSearch input").forEach((v)=>{  // INPUT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         name = v.name.slice(2);  // Take off search level
         value = v.value;
         _struct = name.split("-");
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               /* FIX RADIO INPUTS */
               if(v.type=="radio") if(!v.checked) return;  // Skip this element because it's a radio unchecked

               data[_struct[0]] = value;
               break;
            case 2:  // ARRAY PARAM
               /* FIX RADIO INPUTS */
               if(v.type=="radio") if(!v.checked) return;  // Skip this element because it's a radio unchecked

               if(data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }else{  // If data doesn't has this property
                  data[_struct[0]] = {}  // Initialize as empty object
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }
               break;
            default: return false;
         }
         console.log(data);
      });
      document.querySelectorAll("div#AdvancedSearch select").forEach((v)=>{  // SELECT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         name = v.name.slice(2);  // Take off search level
         value = v.value;
         _struct = name.split("-");
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               data[_struct[0]] = value;
               break;
            case 2:  // ARRAY PARAM
               if(data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }else{  // If data doesn't has this property
                  data[_struct[0]] = {}  // Initialize as empty object
                  data[_struct[0]][_struct[1]] = value;  // Set value
               }
               break;
            default: return false;
         }
         console.log(data);
      });
      console.log("Data: ", data);
      $.ajax({
         type: 'POST',
         url: '{{ route("search.advanced") }}',
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

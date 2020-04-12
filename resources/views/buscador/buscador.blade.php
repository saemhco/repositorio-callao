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
               <input type="text" class="form-control form-control-line" placeholder="DNI - Apellidos Nombres" name="i-author-dni">
            </div>
            <!-- <div class="form-group">
               <input name="i-author-genre" type="radio" id="i-genre-m" class="with-gap radio-col-red" value="M" checked>
               <label for="i-genre-m">Masculino</label>
               <input name="i-author-genre" type="radio" id="i-genre-f" class="with-gap radio-col-red" value="F">
               <label for="i-genre-f">Femenino</label>
            </div> -->
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
               <input name="a-author-dni" type="text" class="form-control form-control-line" placeholder="DNI - Apellidos Nombres">
            </div>
            <!-- <div class="form-group">
               <input name="a-author-genre" type="radio" id="a-genre-m" class="with-gap radio-col-red" value="M" checked>
               <label for="a-genre-m">Masculino</label>
               <input name="a-author-genre" type="radio" id="a-genre-f" class="with-gap radio-col-red" value="F">
               <label for="a-genre-f">Femenino</label>
            </div> -->
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
<div class="card">
   <div id="resultados" class="card-body">
      <i>Aquí se mostrarán los resultados</i>
   </div>
</div>
@endsection
@section('js')
<script src="{{asset('material-pro/assets/plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('material-pro/assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script type="text/javascript">
   const _debug = false;

   function formBasic(){
      if(_debug) console.log("BASIC FORM")
      let data = {};  // Data storage
      document.querySelectorAll("div#BasicSearch input").forEach((v)=>{  // INPUT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         name = v.name.slice(2);  // Take off search level
         value = v.value;
         _struct = name.split("-");
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               /* FIX EMPTY INPUTS */
               if(v.value=="") return;  // Skip if value is empty
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

      if(_debug) console.log("Data: ", data);
      if(Object.entries(data).length==0) return;  // Skip if object is empty
      $.ajax({
         type: 'POST',
         url: '{{ route("search.basic") }}',
         data: {
            _token: "{{ csrf_token() }}",
            data: data,
         },
         success: (e) => {
            if(_debug) console.log(e);
            insertNav(e);
         },
         error: (e) => {
            console.log(e)
         }
      });
   }
   function formIntermediate(){
      if(_debug) console.log("INTERMEDIATE FORM")
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
      document.querySelectorAll("div#IntermediateSearch select").forEach((v)=>{  // SELECT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         name = v.name.slice(2);  // Take off search level
         value = v.value;
         _struct = name.split("-");
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               /* FIX EMPTY INPUTS */
               if(value=="") return;;  // Skip if value is empty
               data[_struct[0]] = value;
               break;
            case 2:  // ARRAY PARAM
               /* FIX EMPTY INPUTS */
               if(value=="") return;;  // Skip if value is empty
               /* FIX NESTED OBJECT */
               if(!data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]] = {}  // Initialize as empty object
               }
               data[_struct[0]][_struct[1]] = value;  // Set value
               break;
            default: return false;
         }
      });

      if(_debug) console.log("Data: ", data);
      if(Object.entries(data).length==0) return;  // Skip if object is empty
      $.ajax({
         type: 'POST',
         url: '{{ route("search.intermediate") }}',
         data: {
            _token: "{{ csrf_token() }}",
            data: data,
         },
         success: (e) => {
            if(_debug) console.log(e);
            insertNav(e);
         },
         error: (e) => {
            console.log(e)
         }
      });
   }
   function formAdvanced(){
      if(_debug) console.log("ADVANCED FORM")
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
               if(v.type=="checkbox") if(!v.checked) return;  // Skip if this element is checkbox and it's unchecked
               /* FIX EMPTY INPUTS */
               if(value=="") return;;  // Skip if value is empty
               /* FIX NESTED OBJECT */
               if(!data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]] = {}  // Initialize as empty object
               }
               data[_struct[0]][_struct[1]] = value;  // Set value
               break;
            default: return false;
         }
      });
      document.querySelectorAll("div#AdvancedSearch select").forEach((v)=>{  // SELECT
         // Validar que el input tenga un valor valido, sino no agregarlo a data
         name = v.name.slice(2);  // Take off search level
         value = v.value;
         _struct = name.split("-");
         switch(_struct.length){  // ['exposition', 'from_date']
            case 1:  // ID PARAM
               /* FIX EMPTY INPUTS */
               if(value=="") return;  // Skip if value is empty
               data[_struct[0]] = value;
               break;
            case 2:  // ARRAY PARAM
               /* FIX EMPTY INPUTS */
               if(value=="") return;;  // Skip if value is empty
               /* FIX NESTED OBJECT */
               if(!data.hasOwnProperty(_struct[0])){  // Check if data already has this property
                  data[_struct[0]] = {}  // Initialize as empty object
               }
               data[_struct[0]][_struct[1]] = value;  // Set value
               break;
            default: return false;
         }
      });

      if(_debug) console.log("Data: ", data);
      if(Object.entries(data).length==0) return;  // Skip if object is empty
      $.ajax({
         type: 'POST',
         url: '{{ route("search.advanced") }}',
         data: {
            _token: "{{ csrf_token() }}",
            data: data,
         },
         success: (e) => {
            if(_debug) console.log(e);
            insertNav(e);
         },
         error: (e) => {
            console.log(e)
         }
      });
   }
   function changeTab(inx){
      show_div = {}
      switch(inx){
         case 1: show_div = document.querySelector('div#BasicSearch'); break;
         case 2: show_div = document.querySelector('div#IntermediateSearch'); break;
         case 3: show_div = document.querySelector('div#AdvancedSearch'); break;
         default: return;
      }
      document.querySelector('div#BasicSearch').classList.add('none');
      document.querySelector('div#IntermediateSearch').classList.add('none');
      document.querySelector('div#AdvancedSearch').classList.add('none');
      show_div.classList.remove('none');
   }
   function insertNav(nav){
      // Prepare container
      res = document.getElementById("resultados");
      // res.parentElement.classList.remove("fade");  // Mosstrar div

      // There is not enought results to make a nav
      let navigation = ``;
      if(nav.next_page_url || nav.prev_page_url){
         // Links
         let links = ``;
         links += `
         <li class="page-item ${!nav.prev_page_url?'disabled':''}">
         <span data-link="${nav.first_page_url}" class="page-link" style="cursor: ${!nav.prev_page_url?'default':'pointer'}" onclick="changePage(this)">&lsaquo;&lsaquo;</span>
         </li>`;
         if(nav.prev_page_url){  // Prev page
            links += `
            <li class="page-item" style="cursor: pointer">
            <span data-link="${nav.prev_page_url}" class="page-link" onclick="changePage(this)">${nav.current_page-1}</span>
            </li>`;
         }
         links += `
         <li class="page-item active" aria-current="page" style="cursor: pointer">
         <span class="page-link">${nav.current_page}</span>
         </li>`;
         if(nav.next_page_url){
            links += `
            <li class="page-item" style="cursor: pointer">
            <span data-link="${nav.next_page_url}" class="page-link" onclick="changePage(this)">${nav.current_page+1}</span>
            </li>`;
         }
         links += `
         <li class="page-item ${!nav.next_page_url?'disabled':''}">
         <span data-link="${nav.last_page_url}" class="page-link" style="cursor: ${!nav.next_page_url?'default':'pointer'}" onclick="changePage(this)">&rsaquo;&rsaquo;</span>
         </li>`;

         // General nav
         navigation = `
         <nav>
         <ul class="pagination">
         ${links}
         </ul>
         </nav>
         `;
      }

      // Result
      let results = ``;
      nav.data.forEach((v) => {
         results += `
         <div>
            <h2><a href="{{route('search.index')}}/${v.id}">${v.titulo}</a></h2>
            <h4>${v.autor}</h4>
            <p>${v.resumen}</p>
         </div>
         `;
      })

      // Content
      let html = `
      <div>
         <b>RESULTADOS</b>
         ${results}
      </div>
      <br>
      <span>Mostrando ítems ${nav.from} - ${nav.to} de ${nav.total}</span>
      ${navigation}
      `;

      res.innerHTML = html;  // Add to container
   }
   function changePage(e){
      $.ajax({
         type: 'POST',
         url: e.getAttribute('data-link'),
         data: {
            _token: "{{ csrf_token() }}",
         },
         success: (e) => {
            insertNav(e);
         },
         error: (e) => {
            console.log(e)
         }
      });
   }

   // Change programa
   $(".set_programa_2" ).change(function(){
      var facultad = $('#facultad_2').val();
      var escuela = $('#escuela_2').val();
      if(!facultad && !escuela){  // Fix no selected options
         $("#programa_academico_2").find('option').remove();
         return;
      }
      $.ajax({
         url: '{{ route("search.getprograma") }}',
         type: 'POST',
         data: {
            _token: "{{ csrf_token() }}",
            fac: facultad,
            nivel_acad: escuela
         },
         success: function (data) {
            $("#programa_academico_2").find('option').remove();
            $.each(data,function(key, registro) {
               $("#programa_academico_2").append('<option value='+registro.id+'>'+registro.descripcion+'</option>');
            });
         },
         error: function(error){
            alert(error);
         }
      })
   });
   $(".set_programa_3" ).change(function(){
      var facultad = $('#facultad_3').val();
      var escuela = $('#escuela_3').val();
      if(!facultad && !escuela){  // Fix no selected options
         $("#programa_academico_2").find('option').remove();
         return;
      }
      $.ajax({
         url: '{{ route("search.getprograma") }}',
         type: 'POST',
         data: {
            _token: "{{ csrf_token() }}",
            fac: facultad,
            nivel_acad: escuela
         },
         success: function (data) {
            $("#programa_academico_3").find('option').remove();
            $.each(data,function(key, registro) {
               $("#programa_academico_3").append('<option value='+registro.id+'>'+registro.descripcion+'</option>');
            });
         },
         error: function(error){
            alert(error);
         }
      })
   });
</script>
@endsection

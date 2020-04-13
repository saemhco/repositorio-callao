const _debug = false;
let _data = {};

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
      _data = data;  // Set this data to global object
      $.ajax({
         type: 'POST',
         url: '/busqueda/basic',
         data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
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
      _data = data;  // Set this data to global object
      $.ajax({
         type: 'POST',
         url: '/busqueda/intermediate',
         data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
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
      _data = data;  // Set this data to global object
      $.ajax({
         type: 'POST',
         url: '/busqueda/advanced',
         data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
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
      $('#body_result').show();
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
      let resumen = '';
      let nivel_academico = getNivelAcademico();
      nav.data.forEach((v) => {
         if(v.resumen!=null && v.resumen.length>350) resumen=v.resumen.substring(0,350)+'...';
         else resumen=v.resumen;
         results += `
         <div data-icon="&#xe012;" class="linea-icon linea-basic col-md-2" style="font-size: 110px; margin-top: -20px; text-align: center; ${nivel_academico[v.nivel_acad_id]["color"]}">
               <h4 style="margin-top: -45px; ${nivel_academico[v.nivel_acad_id]["color"]}">${nivel_academico[v.nivel_acad_id]["text"]}</h4>
         </div>
         <div class="col-md-10">
            <h3><a href="/busqueda/${v.id}" target="_blank"><u>${v.titulo}</u></a></h3>
            <h5>${v.autor}</h5>
            <p style="text-align:justify">${resumen}</p>
         </div><hr class="col-11">
         `;
      })

      // Content
      let html = `
      <div class="row">
         <b class="col-12">Se han encontrado ${nav.total} resultados</b><br><br>
         ${results}
      </div>
      `;
      if(nav.total!==0){
         html += `
         <br>
         <span>Mostrando resultados: ${nav.from} - ${nav.to} de ${nav.total}</span>
         ${navigation}
         `;
      }

      res.innerHTML = html;  // Add to container
   }
   function changePage(e){
      $.ajax({
         type: 'POST',
         url: e.getAttribute('data-link'),
         data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            data: _data,
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

   function getNivelAcademico(){
      var nivel_acad={};
          nivel_acad[1]={'text':'PREGRADO','color':'color:rgba(51,51,153,0.7);'};
          nivel_acad[2]={'text':'SEGUNDA ESPECIALIDAD','color':'color:rgba(51,153,153,0.6);'};
          nivel_acad[3]={'text':'MAESTRIA','color':'color:rgba(240,50,40,0.6);'};
          nivel_acad[4]={'text':'DOCTORADO','color':'color:rgba(170,70,70,0.6);'};
          return nivel_acad;
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
         url: '/busqueda/set_programa',
         type: 'POST',
         data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
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
         url: '/busqueda/set_programa',
         type: 'POST',
         data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
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

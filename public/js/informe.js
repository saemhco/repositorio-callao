$(document).ready(function() {
        var myTable=$('#datatable-ajax').DataTable( {
        // dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
        bProcessing: true,
        sAjaxSource: '/informe/data',
        "language" : {'url':'/js/latino.json'},
        // bPaginate: true,
        // bLengthChange: true,
        // bFilter: true,
        // bSort: true,
        // bInfo: true,
        // // "order": [[0, 'asc'], [4, 'asc']],
         aLengthMenu: [25,50, 100],
         bAutoWidth: true,
          order: []
      })
      $('#textarea_editor1').wysihtml5();
      $('#textarea_editor2').wysihtml5();
      $('#e-textarea_editor1').wysihtml5();
      $('#e-textarea_editor2').wysihtml5();
      // For select 2
      $("#ubigeo").select2({
        dropdownParent: $('#modal_nuevo')
      });

      $("#e-ubigeo").select2({
        dropdownParent: $('#modal_editar')
      });

      $("#persona").select2({
        dropdownParent: $('#personas')
      });

      $(".mostrar_ocultar_otros" ).change(function() {
        switch($(this).val()){
          case '21':case '52':case '90': $($(this).data("div")).show(); break;
          default: $($(this).data("div")).hide(); break;
        }           
      })
      $(".set_programa" ).change(function(){
         if($(this).data("modal")=="nuevo"){
            var facultad = $('#fac').val();
            var nivel_acad = $('#nivel_acad').val();
            var select_programa = $("#programa_academico");   
         }else{
            var facultad = $('#e-fac').val();
            var nivel_acad = $('#e-nivel_acad').val();
            var select_programa = $("#e-programa_academico");
         }
        $.ajax({ 
            url: '/informe/set_programa',
            type: 'GET',
            data: {fac:facultad,nivel_acad:nivel_acad},
            success: function (data) {
              //console.log(data);
              select_programa.find('option').remove();
              $.each(data,function(key, registro) {
                select_programa.append('<option value='+registro.id+'>'+registro.descripcion+'</option>');
              });
            },
            error: function(error){
                   alert(error);
            }
        })        
      })

      $('#c-ua-18').change(function(){
        if($(this).is(":checked")){
          $('#otro_unidad').show();
        }else{
          $('#otro_unidad').hide();
        } 
      })
      $('#e-c-ua-85').change(function(){
        if($(this).is(":checked")){
          $('#e-otro_unidad').show();
        }else{
          $('#e-otro_unidad').hide();
        } 
      })


      
});

   var form = $(".tab-wizard").show();
        $(".tab-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                next: "Siguiente",
                previous: "Anterior",
                finish: 'Terminar'
            },
            onStepChanging: function (event, currentIndex, newIndex) {
              return currentIndex > newIndex || (currentIndex < newIndex && ($(this).find(".body:eq(" + newIndex + ") label.error").remove(), $(this).find(".body:eq(" + newIndex + ") .error").removeClass("error")), $(this).validate().settings.ignore = ":disabled,:hidden", $(this).valid())
            },
            onFinishing: function (event, currentIndex) {
              return $(this).validate().settings.ignore = ":disabled", $(this).valid()
            },
            onFinished: function (event, currentIndex) {
                var route = '/informe/'+$(this).attr('id');
                $.ajax({
                  headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                  data:  $("#"+$(this).attr('id')).serialize(),
                  url:   route,
                  type: 'POST',
                  beforeSend: function () {
                    console.log('enviando....');
                  },
                  success:  function (response){
                     console.log(response);
                    if(!response.resultado){
                      Swal.fire({
                              title: "¡Error!",
                              text: response.msj,
                              icon: "error",
                              timer: 2500,
                          })
                      return false;
                    }
                    $('#datatable-ajax').DataTable().ajax.reload();
                    $('#modal_nuevo').modal('hide');
                    $('#modal_editar').modal('hide');
                    personas(response.data.id,response.data.programa);
                    Swal.fire({
                              title: "¡Éxito!",
                              text: response.msj,
                              icon: "success",
                              timer: 2500,
                              showConfirmButton: false
                          })
                    document.getElementById("form_editar").reset();
                    document.getElementById("form_nuevo").reset();
                    $("#form_editar").steps('reset');
                    $("#form_nuevo").steps('reset');
                  },
                  error: function (response){
                    Swal.fire({
                        title: "¡Error!",
                        text: response.responseJSON.message,
                        icon: "error",
                        timer: 3500,
                    })

                  }
                });
            }
        }), $(".tab-wizard").validate({
            ignore: "input[type=hidden]",
            errorClass: "text-danger",
            successClass: "text-success",
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass)
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass)
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element)
            },
            rules: {
                email: {
                    email: !0
                }
            }
        })
    function personas(id,programa){
      set_personas(id);
      set_responsabilidad_persona(programa);
      set_tabla_personas(id);
      $('#btn_refrescar').attr('onclick', 'set_personas('+id+')');
      $("#btn_guardar").attr("onclick","guardar_nueva_persona("+id+")");
      $('#personas').modal('show'); 
    }
    function set_responsabilidad_persona(programa){
        var optgroup_jurado= $("#condicion_persona").find('optgroup')[2];
        if(optgroup_jurado){
          optgroup_jurado.remove();
        }
      var grupo = $("#condicion_persona").append('<optgroup label="Jurados">');
         $.ajax({ 
              url: '/informe/set_jurado',
              type: 'GET',
              data: {prog:programa},
              success: function (data) {
                $.each(data,function(key, registro){
                  grupo.find('optgroup').last().append('<option value='+registro.id+'>'+registro.descripcion+'</option>');
                });
              },
              error: function(error){
                     console.log(error);
              }
          })
    }
    function set_personas(id){
      $.ajax({ 
            url: '/informe/set_personas',
            type: 'GET',
            data: {id:id},
            success: function (data){
              $("#persona").find('option').remove();
                $("#persona").append('<option value="'+'">DNI - Nombres y Apellidos</option>');
              $.each(data,function(key, persona) {
                $("#persona").append('<option value='+zfill(persona.dni, 8)+'>'+persona.datos+'</option>');
              });
            },
            error: function(error){
                   console.log(error);
            }
        })
    }
    function set_tabla_personas(id){
      $.ajax({ 
            url: '/informe/set_tabla_personas',
            type: 'GET',
            data: {id:id},
            success: function (data) {
              var fila=$("#tabla_personas").find('tbody tr');
              fila.remove();
              $.each(data,function(key, persona) {
                $("#tabla_personas").find('tbody').append('<tr>'+
                    '<td>'+persona.dni+'</td>'+
                    '<td>'+persona.datos+'</td>'+
                    '<td>'+persona.responsabilidad+'</td>'+
                    '<td align="center"><button type="button" class="btn btn-danger btn-circle" onclick="eliminar_personas('+persona.id+','+persona.informe_id+')"><i class="fa fa-trash"></i></button></td>'+

                  '</tr>');
              });
            },
            error: function(error){
                   console.log(error);
            }
        })
    }

    function guardar_nueva_persona(id){
      var persona=$('#persona').val();
      if(persona=='' || persona==null){
        alert('Valor nulo. Debe elegir una persona');
        return false;
      }
      var responsabilidad = $('#condicion_persona').val();
        $.ajax({ 
            url: '/informe/nueva_persona',
            type: 'POST',
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            data: {informe_id:id, persona_id:persona,condicion_id:responsabilidad},
            success: function (data) {
              set_tabla_personas(id);
              set_personas(id);
              $('#datatable-ajax').DataTable().ajax.reload();
            },
            error: function(error){
              console.log(error);
            }
        })
    }

    function eliminar_personas(id_persona,id_informe){
        $.ajax({ 
            url: '/informe/eliminar_persona',
            type: 'POST',
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            data: {id:id_persona},
            success: function (data) {
              set_tabla_personas(id_informe);
              set_personas(id_informe);
              $('#datatable-ajax').DataTable().ajax.reload();
            },
            error: function(error){
              console.log(error);
            }
        })
    }
    function eliminar (id){
         Swal.fire({
                  title: "¿Estás seguro?",
                  text: "Los datos se perderán permanentemente",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: "Si, eliminar",
                  cancelButtonText: "No, cancelar",
                }).then((result) => {
                  if (result.value) {
                    $.ajax({ 
                            url: '/informe/eliminar',
                            type: 'POST',
                            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                            data: {id:id},
                            success: function (data) {
                                $('#datatable-ajax').DataTable().ajax.reload();
                                Swal.fire({
                                    title: "¡Eliminado!",
                                    text: "Se ha eliminado una fila correctamente.",
                                    icon: "success",
                                    timer: 1500,
                                    showConfirmButton: false
                                })
                            },
                            error: function(error){
                                Swal.fire(
                                  'Error',
                                  'Ocurrior un eror interno. Revisar consola',
                                  'error'
                                )
                              console.log(error);
                            }
                        })
                    }else{
                        Swal.fire({
                           title: "Cancelado",
                           text: "La fila no se ha eliminado.",
                           icon: 'error',
                           timer: 2000
                        })
                    }
                  
                })
    }
    function editar (id){    
      //resetar el modal
      document.getElementById("form_editar").reset();
     $( "#form_editar" ).steps('reset');
         $.ajax({ 
             url: '/informe/editar/'+id,
             type: 'GET',
             //headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
             //data: {id:id},
             success: function (data) {
                 //Cargar datos
                 $('#e-id').val(data.id); 
                 $('#e-titulo').val(data.titulo);
                 $('#e-fac').val(data.facultad_id);
                 $('#e-nivel_acad').val(data.nivel_acad_id);
                 $("#e-nivel_acad").change(); //para llamar al evento y setear el programa
                 $('#e-programa_academico').val(data.programa_id);
                 $('#e-textarea_editor1').data("wysihtml5").editor.setValue(data.resumen, true);
                 $('#e-textarea_editor2').data("wysihtml5").editor.setValue(data.objetivos, true);
                 $('#e-cronograma_inicio').val(data.cronograma_inicio);
                 $('#e-cronograma_fin').val(data.cronograma_fin);
                 $('#e-fecha').val(data.fecha_sustentacion);
                 $('#e-modalidad').val(data.modalidad_id);
                 $('#e-linea').val(data.linea_id);
                 $('#e-prioridad').val(data.prioridad_id);
                 $('#e-area_estudio').val(data.area_estudio_id); $('#e-area_estudio').change();
                 $('#e-area_otros').val(data.area_estudio_otro);
                 $('#e-naturaleza').val(data.naturaleza_id);
                 $('#e-enfoque').val(data.enfoque_id);
                 $('#e-corte').val(data.corte_id);
                 $('#e-temporalidad').val(data.temporalidad_id);
                 $('#e-diseño').val(data.diseno_id);
                 $('#e-nivel').val(data.nivel_id);
                 $('#e-ubigeo').val(data.ubigeo_id); $('#e-ubigeo').change(); //para que muestre el seleccionado
                 $('#e-poblacion').val(data.poblacion_id);
                 $('#e-muestra').val(data.muestra_id);
                 $('#e-presupuesto').val(data.presupuesto);
                 $('#e-fuente_financiamiento').val(data.fuente_financiamiento_id); $('#e-fuente_financiamiento').change();
                 $('#e-fuente_otro').val(data.fuente_financiamiento_otro);
                 $('#e-producto').val(data.producto_id); $('#e-producto').change();
                 $('#e-producto_otro').val(data.producto_otro);
                 $('#e-url').val(data.url);
                 if(data.unidad_analisis != null){
                    $.each(data.unidad_analisis.split(","),function(key, valor) {
                        $("#e-c-ua-"+valor).prop("checked", true);
                    });
                  }
                 $('#e-c-ua-85').change();
                 $('#e-unidad_otro').val(data.unidad_analisis_otro);
                 $('#modal_editar').modal('show'); 
             },
             error: function(error){
                 Swal.fire(
                   'Error',
                   error.responseJSON.message,
                   'error'
                 )
               console.log(error);
             }
         })
    }

    function press_btn_file(id){ //uso la función para no dejar de usar el boton upload, ya que el label luce diferente
      $('#file').attr('onchange','save_file('+id+')');
      $('#file').click();
    }

    function save_file(id){
      var file=document.getElementById('file').files[0];
        //console.log(file);
        var route="/informe/guardar_archivo";
        var formData = new FormData();
            formData.append('file', file);
            formData.append('id', id);
            formData.append('_token', $('input[name=_token]').val());
        $.ajax({
          data: formData,
          url:   route,
          type: 'POST',
          cache:false,
          contentType: false,
          processData: false,
          beforeSend: function () {
          Swal.fire({
              // title: 'Importando Usuarios',
              html:
                "<h3><span><i class=\"fa fa-spinner fa-spin fa-lg\"></i></span> Guardando...</h3>"+
                            'Por favor espere, este proceso puede tardar varios segundos.<br>'
                        }
                      )
          },
          success:  function (response) {
            $('#datatable-ajax').DataTable().ajax.reload();
            Swal.fire({
                        title: "¡Éxito!",
                        text: 'Se guardo el documento',
                        icon: "success",
                        timer: 1500,
                    })
            //console.log(response);
          },
          error:  function (response) {
            Swal.fire({
                        title: "¡Error!",
                        text: 'Ocurrió un error, pruebe con un archivo ligero',
                        icon: "error",
                        timer: 2000,
                    })
            console.log(response);
          }
        });
        file.value = "";
    }
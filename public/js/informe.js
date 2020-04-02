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
      // For select 2
      $(".select2").select2({
        dropdownParent: $('#modal_nuevo')
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
        var facultad = $('#fac').val();
        var nivel_acad = $('#nivel_acad').val();
        //set_jurado(programa);
        $.ajax({ 
            url: '/informe/set_programa',
            type: 'GET',
            data: {fac:facultad,nivel_acad:nivel_acad},
            success: function (data) {
              //console.log(data);
              $("#programa_academico").find('option').remove();
              $.each(data,function(key, registro) {
                $("#programa_academico").append('<option value='+registro.id+'>'+registro.descripcion+'</option>');
              });
            },
            error: function(error){
                   alert(error);
            }
        })        
      })

      $('#c-ua-18').change(function(){
        //console.log($(this).is(":checked"));
        if($(this).is(":checked")){
          $('#otro_unidad').show();
        }else{
          $('#otro_unidad').hide();
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
              return currentIndex > newIndex || (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
            },
            onFinishing: function (event, currentIndex) {
              return form.validate().settings.ignore = ":disabled", form.valid()
            },
            onFinished: function (event, currentIndex) {
                var token=$("#token").val(); //El token solo en casos del tipo POST
                //console.log($("#form_nuevo").serialize());
                var route = '/informe/store'
                $.ajax({
                  headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                  data:  $("#form_nuevo").serialize(),
                  url:   route,
                  type: 'POST',
                  beforeSend: function () {
                    console.log('enviando....');
                  },
                  success:  function (response){
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
                    personas(response.data.id,response.data.programa);
                    Swal.fire({
                              title: "¡Éxito!",
                              text: "Se registró una nueva investigación. Continúe registrando los datos del autor y otros (personas).",
                              icon: "success",
                              timer: 2500,
                              showConfirmButton: false
                          })
                    document.getElementById("form_nuevo").reset();
                    $( ".tab-wizard" ).steps('reset');
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
                $("#persona").append('<option value='+persona.dni+'>'+persona.datos+'</option>');
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
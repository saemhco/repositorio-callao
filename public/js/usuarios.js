$(document).ready(function() {
        var myTable=$('#datatable-ajax').DataTable( {
        // dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
        bProcessing: true,
        sAjaxSource: '/usuarios/data',
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
});

 

    function nuevo (){
      if(!validar_formulario('#'))
         return false;

      var route = "/usuarios/nuevo";
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
              Swal.fire({
                        title: "¡Éxito!",
                        text: response.msj,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    })
              document.getElementById("form_nuevo").reset();
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
                            url: '/usuarios/eliminar',
                            type: 'POST',
                            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                            data: {id:id},
                            success: function (data) {
                                if(data){
                                	$('#datatable-ajax').DataTable().ajax.reload();
	                                Swal.fire({
	                                    title: "¡Eliminado!",
	                                    text: "Se ha eliminado una fila correctamente.",
	                                    icon: "success",
	                                    timer: 1500,
	                                    showConfirmButton: false
	                                })
                                }else{
                                	Swal.fire(
	                                  'Error',
	                                  'El usuario registro varios trabajos de investigación, no se puede borrar porque se perderian esos registros',
	                                  'error'
	                                )
                                }
                            },
                            error: function(error){
                                Swal.fire(
                                  'Error',
                                  'Ocurrió un eror interno. Revisar consola',
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
         $.ajax({ 
             url: '/usuarios/editar/'+id,
             type: 'GET',
             success: function (data) {
               //console.log(data);
                 //Cargar datos
                 $('#e-nombres').val(data.nombres);
                 $('#e-apellidos').val(data.apellidos);
                 $('#e-username').val(data.username);
				 $('#e-email').val(data.email);
                 $('#id').val(data.id);
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

    function actualizar (){
      if(!validar_formulario('#e-'))
         return false;
      var route = "/usuarios/actualizar";
          $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            data:  $("#form_editar").serialize(),
            url:   route,
            type: 'POST',
            beforeSend: function () {
              console.log('enviando....');
            },
            success:  function (response){
               //console.log(response);
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
              $('#modal_editar').modal('hide'); 
              Swal.fire({
                        title: "¡Éxito!",
                        text: response.msj,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    })
              document.getElementById("form_editar").reset();

            },
            error: function (response){
               console.log(response);
              Swal.fire({
                  title: "¡Error!",
                  text: response.responseJSON.message,
                  icon: "error",
                  timer: 3500,
              })

            }
          });
    }

    function validar_formulario(pre){
      var result;
      var e=true;
      var a = validar_dom(pre+'nombres');
      var b = validar_dom(pre+'apellidos');
      var c = validar_dom(pre+'email');
      var d = validar_dom(pre+'username');
      if(pre=='#')
      	{e = validar_dom(pre+'password');}
      result = a&&b&&c&&d&&e;
      return result;  
    }

    function validar_dom(id_input){
      if($(id_input).val()==""){
         $(id_input+"_error").show();
         return false;
      }
      else{
         $(id_input+"_error").hide();
         return true;
      }
    }

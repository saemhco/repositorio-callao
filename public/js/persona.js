$(document).ready(function() {
        var myTable=$('#datatable-ajax').DataTable( {
        // dom: '<"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
        bProcessing: true,
        sAjaxSource: '/personas/data',
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
      var route = "/personas/nuevo";
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
                            url: '/personas/eliminar',
                            type: 'POST',
                            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                            data: {dni:id},
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
         $.ajax({ 
             url: '/personas/editar/'+id,
             type: 'GET',
             //headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
             //data: {id:id},
             success: function (data) {
               console.log(data);
                 //Cargar datos
                 $('#e-dni').val(zfill(data.dni, 8)); 
                 $('#e-nombres').val(data.nombres);
                 $('#e-apellidos').val(data.apellidos);
                 $('#e-genero').val(data.genero);
                 $('#id').val(data.dni);
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
      var route = "/personas/actualizar";
          $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            data:  $("#form_editar").serialize(),
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
              Swal.fire({
                        title: "¡Éxito!",
                        text: response.msj,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    })
              $('#modal_editar').modal('hide'); 
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
    function importar(){
      var file=document.getElementById('importar-usuarios').files[0];
        console.log(file);
        var route="/personas/importacion_masiva";
        var formData = new FormData();
            formData.append('file', file);
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
                "<h3><span><i class=\"fa fa-spinner fa-spin fa-lg\"></i></span> Importando Usuarios</h3>"+
                            'Por favor espere, este proceso puede tardar unos minutos...<br>'+
                '<br><p><b>NOTA:</b> Evite repetir valores en la coluna DNI, estos registros se omitirán para evitar errores.</p>'
                        }
                      )
          },
          success:  function (response) {
            $('#datatable-ajax').DataTable().ajax.reload();
            Swal.fire(
                      '¡Éxito!',
                      'Se registraron correctamente',
                      'success'
                      )
            console.log(response);
          },
          error:  function (response) {
            Swal.fire(
                      '¡Error!',
                      'Ocurrió un error, revise lo siguiente: <br> -Que todos los datos del archivo .xlsx sean válidos (no nulos). <br> -Pruebe con menos registros.',
                      'error'
                      )
            console.log(response);
          }
        });
        document.getElementById("importar-usuarios").value = "";
    }

    function zfill(number, width) {
       var numberOutput = Math.abs(number); /* Valor absoluto del número */
       var length = number.toString().length; /* Largo del número */ 
       var zero = "0"; /* String de cero */  
       
       if (width <= length) {
           if (number < 0) {
                return ("-" + numberOutput.toString()); 
           } else {
                return numberOutput.toString(); 
           }
       } else {
           if (number < 0) {
               return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
           } else {
               return ((zero.repeat(width - length)) + numberOutput.toString()); 
           }
    }
}
$(document).ready(function() {
      $(function () {
          var table = $('#myTable').DataTable({
             'language' : {'url':'/js/latino.json'},
             'order': [[ 1, "desc" ]]
          });
       });
      $('#textarea_editor1').wysihtml5();
      $('#textarea_editor2').wysihtml5();
      // For select 2
      $(".select2").select2({
        dropdownParent: $('#full-width-modal')
      });

      $(".mostrar_ocultar_otros" ).change(function() {
        //alert($(this).val());
        switch($(this).val()){
          case '21':case '52':case '90': $($(this).data("div")).show(); break;
          default: $($(this).data("div")).hide(); break;
        }           
      });
      $(".set_programa" ).change(function(){
        var facultad = $('#fac').val();
        var programa = $('#prog').val();
        set_jurado(programa);
        $.ajax({ 
            url: '/informe/set_programa',
            type: 'GET',
            data: {fac:facultad,prog:programa},
            success: function (data) {
              $("#progama_d").find('option').remove();
              $.each(data,function(key, registro) {
                $("#progama_d").append('<option value='+registro.id+'>'+registro.descripcion+'</option>');
              });
            },
            error: function(error){
                   alert(error);
            }
        })        
      });
});

 //wizard-step
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
      onFinished: function (event, currentIndex) {
         swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
      }
   });
function set_jurado(programa){
   var optgroup_jurado= $("#condicion_persona").find('optgroup')[2];
   if(optgroup_jurado){
      optgroup_jurado.remove();
   }
   var grupo = $("#condicion_persona").append('<optgroup label="Jurados">');
   $.ajax({ 
        url: '/informe/set_jurado/',
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
set_jurado();
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Ing. Saúl Escandón Munguía">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{substr(\App\Ajuste::find(1)->elemento('icono'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('icono'))
                                    :asset(\App\Ajuste::find(1)->elemento('icono'))}}">
    <title>{{\App\Ajuste::find(1)->elemento('título')}}</title>
    <link rel="canonical" href="{{ route('index') }}"/>
    @yield('css')
    <!-- Custom CSS -->
    <link href="{{asset('material-pro/horizontal/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('material-pro/horizontal/css/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="fix-header card-no-border logo-center">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header" style="margin:0;">
                    <a class="navbar-brand" href="{{ route('index') }}">
                        <img src="{{substr(\App\Ajuste::find(1)->elemento('logo'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('logo'))
                                    :asset(\App\Ajuste::find(1)->elemento('logo'))}}" 
                              alt="Logo" class="light-logo" height="45px" />
                        <img src="{{substr(\App\Ajuste::find(1)->elemento('logo texto 1'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('logo texto 1'))
                                    :asset(\App\Ajuste::find(1)->elemento('logo texto 1'))}}" 
                                    class="light-logo" alt="Logo-Texto"  style="max-width: 198px; max-height: 45px"/>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0"></ul><!--Para que el sgt UL esté alineado a la derecha-->
                    <ul class="navbar-nav my-lg-0">
                        @if(Auth::user())
                        {{-- Las tres lineas del menú, cuando se comprima --}}
                         <li class="nav-item"> 
                            <a class="nav-link nav-toggler d-block d-md-none text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-close mdi mdi-menu"></i>
                            </a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link sidebartoggler d-none d-md-block text-muted waves-effect waves-dark" href="javascript:void(0)"><i class=""></i>
                         </a>
                        </li>
                        {{-- Fin de las tres lineas --}}

                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('/material-pro/assets/images/users/'.Auth::user()->foto)}}" alt="user" class="profile-pic" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img">
                                                <img src="{{ asset('/material-pro/assets/images/users/'.Auth::user()->foto)}}" alt="user"></div>
                                            <div class="u-text">
                                                <h5>{{ Auth::user()->nombres }}</h5>
                                                <h6>{{ Auth::user()->apellidos }}</h6>
                                                <label class="btn btn-rounded btn-danger btn-sm">{{ Auth::user()->descripcion_rol() }}</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    {{-- <li><a href="#"><i class="ti-user"></i> Mi Perfil</a></li> --}}
                                    {{-- <li><a href="#"><i class="ti-wallet"></i> Mis Registros</a></li> --}}
                                    @if(Auth::user()->rol=='0')
                                    <li><a href="{{ route('user.index') }}"><i class="icon-people"></i> Administrar Usuarios</a></li>
                                    @endif
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#" data-toggle="modal" data-target="#configurar_mi_cuenta">
                                        <i class="mdi mdi-account-settings-variant"></i> Configurar mi cuenta</a>
                                    </li>
                                    <li><a href="{{ route('ajustes.index') }}" style="color: red;">
                                        <i class="ti-settings"></i><b> Ajustes del aplicativo</b></a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{route('logout')}}" onclick="event.preventDefault();
                                        document.getElementById('salir').submit();"><i class="fa fa-power-off"></i> Salir</a>
                                        <form id="salir" action="{{route('logout')}}" method='POST'>
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                
                                </ul>
                            </div>
                        </li>
                        @endif
                        <!-- ============================================================== -->
                        <!-- Tutoriales -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                    class="mdi mdi-help-circle-outline" title="ayuda"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <a class="dropdown-item"
                                    href="{{ \App\Ajuste::find(1)->elemento('video tutorial usuario') }}" target="_blank">
                                    <i class="mdi mdi-play-box-outline"></i> Video tutorial
                                </a>
                                <a class="dropdown-item"
                                    href="{{ \App\Ajuste::find(1)->elemento('manual usuario') }}" target="_blank">
                                    <i class="mdi mdi-file-pdf"></i> Manual
                                </a>
                                    @if(Auth::user())
                                    <hr>
                                <a class="dropdown-item"
                                    href="{{ \App\Ajuste::find(1)->elemento('video tutorial administrador') }}" target="_blank">
                                    <i class="mdi mdi-play-box-outline"></i> AMD - Video tutorial
                                </a>
                                <a class="dropdown-item"
                                    href="{{ \App\Ajuste::find(1)->elemento('manual administrador') }}" target="_blank">
                                    <i class="mdi mdi-file-pdf"></i> AMD - Manual
                                </a> 
                                    @endif
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @if(Auth::user())
        <aside class="left-sidebar" >
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        {{-- <li class="nav-small-cap">Registro</li> --}}
                        <li>
                            <a class="has-arrow" href="{{ route('dasboard.index') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li>
                            <a class="has-arrow" href="{{ route('informe.index') }}" aria-expanded="false">
                                <i class="mdi mdi-file-document"></i><span class="hide-menu">Registro </span>
                            </a>
                            {{-- <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('informe.index') }}">Según investigación</a></li>
                                <li><a href="#">Según registrador</a></li>
                            </ul> --}}
                        </li>
                        <li>
                            <a class="has-arrow " href="{{ route('personas.index') }}" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i><span class="hide-menu">Personas</span></a>
                           {{--  <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('personas.index') }}">Investigación (personas)</a></li>
                                @if(Auth::user()->rol=='0')
                                <li><a href="app-chat.html">Administración  (usuarios)</a></li>
                                @endif
                            </ul> --}}
                        </li>
                        <li>
                            <a class="has-arrow" href="{{ route('ajustes.index') }}" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Ajustes</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        @endif
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-12 align-self-center">
                        <h3 class="text-themecolor mb-0 mt-0">@yield('title')</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('login') }}">Principal</a>
                            </li>
                            @yield('routes')                            
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
                <div class="row" >
                    <div class="col-12">
                        @yield('content')
                        @if(Auth::user())
                        <!--  Modal content for the above example -->
                                <div class="modal fade" id="configurar_mi_cuenta" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">
                                                    <i class="mdi mdi-account-settings-variant"></i> Configurar mi cuenta
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div><br>
                                            <form action="#" id="home_form_editar">
                                            <div class="modal-body">
                                                <div class="row floating-labels">
                                                    <div class="form-group col-md-12">
                                                       <input value="{{ Auth::user()->nombres}}" type="text" class="form-control" name="nombres" 
                                                       onkeypress="validar_dom('#home-nombres')" required="true" id="home-nombres">
                                                       <span class="bar"></span>
                                                       <label for="nombres">Nombres
                                                          <small id="home-nombres_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                       </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input value="{{ Auth::user()->apellidos}}" type="text" class="form-control" name="apellidos" id="home-apellidos" onkeypress="validar_dom('#home-apellidos')" required>
                                                       <span class="bar"></span>
                                                       <label for="e-apellidos">Apellidos
                                                         <small id="home-apellidos_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                       </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input value="{{ Auth::user()->email}}" type="text" class="form-control" name="email" id="home-email" onkeypress="validar_dom('#home-email');">
                                                       <span class="bar"></span>
                                                       <label for="home-email" required>E-mail
                                                          <small id="home-email_error" style="color: red; display: none"> *este campo es obligatorio</small>
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input value="{{ Auth::user()->username}}" type="text" class="form-control" disabled="none">
                                                       <span class="bar"></span>
                                                       <label for="home-username">Usuario </label>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                       <input type="password" maxlength="15" class="form-control" name="password" id="home-password" required>
                                                       <span class="bar"></span>
                                                       <label for="home-password">Contraseña (opcional)
                                                        </label>
                                                    </div>                                                  
                                                </div>
                                              
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" id="id">
                                                <label class="btn btn-success btn-block" type="button" onclick="configurar_mi_cuenta()">Actualizar</label>
                                            </div>
                                            </form>
                                        </div><!-- /.modal-content -->

                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                        @endif
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">{{\App\Ajuste::find(1)->elemento('pie pagina 1')}} <small>| {{\App\Ajuste::find(1)->elemento('pie pagina 2')}}</small>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('/material-pro/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('/material-pro/assets/plugins/popper/popper.min.js')}}"></script>
    <script src="{{ asset('/material-pro/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('/material-pro/horizontal/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('/material-pro/horizontal/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('/material-pro/horizontal/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{ asset('/material-pro/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{ asset('/material-pro/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('/material-pro/horizontal/js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('/material-pro/assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    @yield('js')
    <script type="text/javascript">
    //Solo permita números
    function validar(e){
      tecla = (document.all) ? e.keyCode : e.which;

      //Tecla de retroceso para borrar, siempre la permite
      if ((tecla==8)||(tecla==46)){
          return true;
      }
          
      // Patron de entrada, en este caso solo acepta numeros
      patron =/[0-9]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
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


    function configurar_mi_cuenta (){
      if(   $('#home-nombres').val()=='' ||
            $('#home-apellidos').val()=='' ||
            $('#home-email').val()==''
        ){
            Swal.fire({
                title: "¡Error!",
                text: 'Llenar todos los campos',
                icon: "alert",
                timer: 2500,
            })
            return false;
        }
      var route = "/configurar_mi_cuenta";
          $.ajax({
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            data:  $("#home_form_editar").serialize(),
            url:   route,
            type: 'POST',
            beforeSend: function () {
              console.log('enviando....');
            },
            success:  function (response){
                Swal.fire({
                        title: "¡Éxito!",
                        text: 'Se actualizaron sus datos',
                        icon: "success",
                        timer: 1000,
                        showConfirmButton: false
                    })
                $('#configurar_mi_cuenta').modal('hide');
                setTimeout(function(){  location.reload(); }, 300); //esperar < 1 seg antes de recargar
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

    </script>
</body>

</html>
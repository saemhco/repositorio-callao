<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{substr(\App\Ajuste::find(1)->elemento('icono'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('icono'))
                                    :asset(\App\Ajuste::find(1)->elemento('icono'))}}">
    <title>Iniciar Sesión</title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/materialpro/" />
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="{{ asset('material-pro/material/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('material-pro/material/css/colors/blue.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
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
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{substr(\App\Ajuste::find(1)->elemento('imagen fondo login'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('imagen fondo login'))
                                    :asset(\App\Ajuste::find(1)->elemento('imagen fondo login'))}}); background-repeat: no-repeat; background-size: 100% 100%;">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('validaracceso') }}">
                        @csrf
                        <div class="navbar-header" align="center">
                            <a class="navbar-brand" href="{{ route('index') }}" title="Ir al buscador">
                                <img src="{{substr(\App\Ajuste::find(1)->elemento('logo'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('logo'))
                                    :asset(\App\Ajuste::find(1)->elemento('logo'))}}"  alt="homepage" class="light-logo" height="45px" /> 
                                <img src="{{substr(\App\Ajuste::find(1)->elemento('logo texto 2'), 0,6)=='public'
                                    ?Storage::url(\App\Ajuste::find(1)->elemento('logo texto 2'))
                                    :asset(\App\Ajuste::find(1)->elemento('logo texto 2'))}}" class="logo" alt="Logo-oscuro" 
                                    style="max-width: 198px; max-height: 45px" />
                            </a>
                        </div>
                        <br>
                        {{-- <h3 class="p-2 rounded-title mb-3" align="center"><u>Iniciar Sesión</u></h3> --}}
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input id="dni" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Usuario" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ingresar</button>
                            </div>
                        </div>
                       
                    </form>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('material-pro/assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('material-pro/assets/plugins/popper/popper.min.js')}}"></script>
    <script src="{{ asset('material-pro/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('material-pro/material/js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('material-pro/material/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('material-pro/material/js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{ asset('material-pro/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{ asset('material-pro/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('material-pro/material/js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('material-pro/assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    
</body>

</html>
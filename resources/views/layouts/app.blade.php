<!DOCTYPE html>
<html lang="en"> 
<head>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.html" >
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta charset="UTF-8">
    <title>@yield('pageTitle') | Plateforme de gestion de formation</title>
    <link rel="website" href="{{ url('/') }}">
    <base href="{{ url('/') }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' name='viewport' >
    <meta name="viewport" content="width=device-width" >

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" >
    
    <!--  Paper Dashboard CSS    -->
    <link href="{{ asset('assets/css/app.css')}}" rel="stylesheet" >

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" >

    <!--     Fonts and icons     -->
    <link href="{{ asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-muli.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/sweetalert/css/sweetalert2.min.css')}}" rel="Stylesheet" >
    <link href="{{ asset('assets/vendors/select2/select2.min.css')}}" rel="Stylesheet" >
    <!--     custom style css     -->

    <link href="{{ asset('assets/css/alerts.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/margin-padding.css')}}" rel="stylesheet">

    <link href="{{ App\Asset::path('app.css') }}" rel="stylesheet">
</head>
<body id="app-layout">
    <div class="spinner-wp">
        <i class="fa fa-gear fa-spin fa-5x" aria-hidden="true"></i>
    </div>
    <div class="wrapper">
        <div class="sidebar" data-background-color="brown" data-active-color="danger">
        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->
            <div class="logo">
                @role('admin')
                <a href="{{ url('/') }}" class="simple-text">
                    Espace Admin
                </a>
                @endrole
                @role('user')
                <a href="{{ url('/') }}" class="simple-text">
                    Espace utilisateur
                </a>
                @endrole
                @role('collaborateur')
                <a href="{{ url('/espace-collaborateurs') }}" class="simple-text">
                    Espace Collaborateur
                </a>
                @endrole
            </div>
            <div class="logo logo-mini">
                <a href="javascript:void(0)" class="simple-text">
                    @role('admin') A @endrole
                    @role('user') U @endrole
                    @role('collaborateur') C @endrole
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    @role(['collaborateur'])
                    <li class="{{ Request::path() == 'espace-collaborateurs' ? 'active' : '' }}" >
                        <a href="{{url('/espace-collaborateurs')}}">
                            <i class="fa fa-graduation-cap"></i>
                            <p>Cours</p>
                        </a>
                    </li>
                    @endrole
                    @role(['admin', 'user'])
                    <li class="{{ Request::path() == '/' ? 'active' : '' }}" >
                        <a href="{{url('/')}}">
                            <i class="fa fa-tachometer"></i>
                            <p>Tableau de board</p>
                        </a>
                    </li>
                    @endrole

                    @permission('prestataires')
                    <li class="{{ Request::is('prestataires*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#prestataires" class="{{ Request::is('prestataires*') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is('prestataires*') ? 'true' : 'false' }}">
                            <i class="fa fa-handshake-o"></i>
                            <p>Prestataires
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{ Request::is('prestataires*') ? 'in' : '' }}" id="prestataires" role="navigation" aria-expanded="{{ Request::is('prestataires*') ? 'true' : 'false' }}" >
                            <ul class="nav">
                                <li class="{{ Request::is('prestataires') ? 'active' : '' }}">
                                    <a href="{{ url('prestataires') }}"><i class="fa fa-list"></i> Liste</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('cours')
                    <li class="{{ Request::is('cours*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#cours" class="{{ Request::is('prestataires*') ? '' : 'collapsed' }}" aria-expanded="{{ Request::is('prestataires*') ? 'true' : 'false' }}">
                            <i class="fa fa-book"></i>
                            <p>Cours
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{ Request::is('cours*') ? 'in' : '' }}" id="cours" role="navigation" aria-expanded="{{ Request::is('prestataires*') ? 'true' : 'false' }}" >
                            <ul class="nav">
                                <li class="{{ Request::is('cours/list') ? 'active' : '' }}">
                                    <a href="{{ url('cours/list') }}"><i class="fa fa-list"></i>Liste</a>
                                </li>
                                <li class="{{ Request::is('cours/u/gestion') ? 'active' : '' }}">
                                    <a href="{{ url('cours/u/gestion') }}"><i class="fa fa-gear"></i> Gestion</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('salles')
                    <li class="{{ Request::is('salles*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#salles" class="collapsed" aria-expanded="{{ Request::is('salles*') ? 'true' : 'false' }}">
                            <i class="fa fa-university"></i>
                            <p>Salles
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{ Request::is('salles*') ? 'in' : '' }}" id="salles" role="navigation" aria-expanded="{{ Request::is('salles*') ? 'true' : 'false' }}" >
                            <ul class="nav">
                                <li class="{{ Request::is('salles/list') ? 'active' : '' }}">
                                    <a href="{{url('salles/list')}}"><i class="fa fa-list"></i>Liste</a>
                                </li>
                                <li class="{{ Request::is('salles/s/gestion') ? 'active' : '' }}">
                                    <a href="{{url('salles/s/gestion')}}"><i class="fa fa-gear"></i> Occupations</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('sessions')
                    <li class="{{ Request::is('sessions*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#sessions" class="collapsed" aria-expanded="{{ Request::is('sessions*') ? 'true' : 'false' }}">
                            <i class="fa fa-graduation-cap"></i>
                            <p>Sessions
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{ Request::is('sessions*') ? 'in' : '' }}" id="sessions" role="navigation" aria-expanded="{{ Request::is('sessions*') ? 'true' : 'false' }}" >
                            <ul class="nav">
                                <li class="{{ Request::is('sessions/list') ? 'active' : '' }}">
                                    <a href="{{ url('sessions/list') }}"><i class="fa fa-list"></i>Liste</a>
                                </li>
                                <li class="{{ Request::is('sessions/participants/list') ? 'active' : '' }}">
                                    <a href="{{ url('sessions/participants/list') }}"><i class="fa fa-list"></i> Participants</a>
                                </li>
                                <li class="{{ Request::is('sessions/budgets/list') ? 'active' : '' }}">
                                    <a href="{{ url('sessions/budgets/list') }}"><i class="fa fa-usd"></i> Budgets</a>
                                </li>
                                <li class="{{ Request::is('sessions/formateurs/list') ? 'active' : '' }}">
                                    <a href="{{ url('sessions/formateurs/list') }}"><i class="fa fa-list"></i> Formateurs</a>
                                </li>
                                <li class="{{ Request::is('sessions/formateurs/gestion') ? 'active' : '' }}">
                                    <a href="{{ url('sessions/formateurs/gestion') }}"><i class="fa fa-gear"></i> Gestion de formateurs</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('rapports')
                    <li class="{{ Request::is('rapports*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#session" class="collapsed" aria-expanded="false">
                            <i class="fa fa-bar-chart"></i>
                            <p>Rapports
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="session" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('rapports/standard') }}"><i class="fa fa-file-o"></i> Standard</a>
                                </li>
                                <li>
                                    <a href="{{ url('rapports/personnalise') }}"><i class="fa fa-file-text-o"></i> Personnalisé</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('evaluations')
                    <li class="{{ Request::is('evaluations*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#evaluation" class="collapsed" aria-expanded="false">
                            <i class="fa fa-question-circle-o"></i>
                            <p>Evaluations
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="evaluation" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('evaluations') }}"><i class="fa fa-list" aria-hidden="true"></i>Liste</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endpermission
                    @permission('utilisateurs')
                    <li class="{{ Request::is('utilisateurs*') ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#users" class="collapsed" aria-expanded="false">
                            <i class="fa fa-gear"></i>
                            <p>Administration
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="users" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('utilisateurs') }}"><i class="fa fa-list" aria-hidden="true"></i> Utilisateurs</a>
                                </li>
                                <li>
                                    <a href="{{url('utilisateurs/roles')}}"><i class="fa fa-list" aria-hidden="true"></i> Rôles</a>
                                </li>
                                <li>
                                    <a href="{{url('utilisateurs/permissions')}}"><i class="fa fa-list" aria-hidden="true"></i> Permissions</a>
                                </li>
                                <!-- <li>
                                    <a href="{{ url('utilisateurs/droits-acces') }}"><i class="" aria-hidden="true"></i> Droits d'accès </a>
                                </li> -->
                            </ul>
                        </div>
                    </li>
                    @endpermission
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="ti-arrow-left"></i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        @role(['admin', 'user'])
                            <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-home"></i> Accueil </a>
                        @endrole
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Register</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} :
                                        @foreach(Auth::user()->roles as $role)
                                            {{$role->name}}
                                        @endforeach
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> Déconnexion</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                @yield('content')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="javascript:void(0)">e-Formation</a>
                    </p>
                </div>
            </footer>
        </div>

    </div>

    <!--   Core JS Files   -->
    @if(Request::is('evaluations*'))
    <script src="{{ asset('assets/vendors/jquery-2.1.3.min.js')}}" type="text/javascript"></script> 
    @else
    <script src="{{ asset('assets/vendors/jquery-3.1.1.min.js')}}" type="text/javascript"></script> 
    @endif
    <script src="{{ asset('assets/vendors/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapValidator.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/material.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/jquery-equal-height.min.js')}}" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/vendors/jquery.validate.min.js')}}"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="{{ asset('assets/vendors/moment.min.js')}}"></script>
    <!--  Charts Plugin -->
    <script src="{{ asset('assets/vendors/charts/chartjs/Chart.min.js')}}" type="text/javascript"></script>
    <!--  Charts Plugin -->
    <script src="{{ asset('assets/vendors/chartist.min.js')}}"></script>
    <!--  Plugin for the Wizard -->
    <script src="{{ asset('assets/vendors/jquery.bootstrap-wizard.js')}}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets/vendors/bootstrap-notify.js')}}"></script>
    <!-- DateTimePicker fr Plugin -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datetimepicker.js')}}"></script>
    <!--  Checkbox, Radio, Switch and Tags Input Plugins -->
    <!-- DateTimePicker Plugin -->
    <script src="{{ asset('assets/js/bootstrap-checkbox-radio-switch-tags.js')}}"></script>
    <!-- Vector Map plugin -->
    <script src="{{ asset('assets/vendors/jquery-jvectormap.js')}}"></script>
    <!-- Sliders Plugin -->
    <script src="{{ asset('assets/vendors/nouislider.min.js')}}"></script>
    <!-- Select Plugin -->
    <script src="{{ asset('assets/vendors/jquery.select-bootstrap.js')}}"></script>
    <!--  DataTables.net Plugin    -->
    <!-- <script src="{{ asset('assets/vendors/jquery.datatables.js')}}"></script> -->
    <!-- Sweet Alert 2 plugin -->
    <script src="{{ asset('assets/vendors/sweetalert/js/sweetalert2.min.js')}}"></script>
    <!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('assets/vendors/jasny-bootstrap.min.js')}}"></script>
    <!--  Full Calendar Plugin    -->
    <script src="{{ asset('assets/vendors/fullcalendar.min.js')}}"></script>
    <!-- TagsInput Plugin -->
    <script src="{{ asset('assets/vendors/jquery.tagsinput.js')}}"></script>
    <!-- select2 Plugin -->
    <script src="{{ asset('assets/vendors/select2/select2.min.js')}}"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('assets/js/amaze.js')}}"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/demo.js')}}"></script>
    <!-- <script src="{{ asset('assets/js/charts/chartjs-charts.js')}}"></script> -->
    <script src="{{ asset('assets/js/script.js')}}?v={{ time() }}"></script>
        
    <script src="{{ App\Asset::path('app.js') }}"></script>
            
    @yield('javascript')

</body>
</html>

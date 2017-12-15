<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8" >
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.html" >
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >

    <title>Accueil | Plateforme de gestion de formation</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' name='viewport' >
    <meta name="viewport" content="width=device-width" >

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" >

    <!--  Paper Dashboard CSS    -->
    <link href="{{ asset('assets/css/amaze.css')}}" rel="stylesheet" >

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" >

    <!--     Fonts and icons     -->
    <link href="{{ asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-muli.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/sweetalert/css/sweetalert2.min.css')}}" rel="Stylesheet" >
    <!--     custom style css     -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>
<body id="app-layout">
    <div class="wrapper">
        <div class="sidebar" data-background-color="brown" data-active-color="danger">
        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                    Espace Admin
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="#" class="simple-text">
                    A
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">

                    <li class="active">
                        <a href="index-2.html">
                            <i class="fa fa-tachometer"></i>
                            <p>Tableau de board</p>
                        </a>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#Fournisseurs" class="collapsed" aria-expanded="false">
                            <i class="fa fa-handshake-o"></i>
                            <p>Prestataires
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="Fournisseurs" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('fournisseurs') }}"><i class="fa fa-list"></i> Prestataires</a>
                                </li>
                                <li>
                                    <a href="{{ url('fournisseurs/create') }}"><i class="fa fa-plus"></i> Ajouter</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#formations" class="collapsed" aria-expanded="false">
                            <i class="fa fa-book"></i>
                            <p>Cours
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="formations" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('cours') }}"><i class="fa fa-list"></i> Cours</a>
                                </li>
                                <li>
                                    <a href="{{ url('cours/create') }}"><i class="fa fa-plus"></i> Ajouter</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#salles" class="collapsed" aria-expanded="false">
                            <i class="fa fa-university"></i>
                            <p>Salles
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="salles" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{url('salles')}}"><i class="fa fa-list"></i> Salles</a>
                                </li>
                                <li>
                                    <a href="{{url('salles/create')}}"><i class="fa fa-plus"></i> Ajouter</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#cours" class="collapsed" aria-expanded="false">
                            <i class="fa fa-calendar"></i>
                            <p>Sessions
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="cours" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('sessions') }}">Sessions</a>
                                </li>
                                <li>
                                    <a href="{{ url('sessions/create') }}">Ajouter</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#ps" class="collapsed" aria-expanded="false">
                            <i class="fa fa-vcard"></i>
                            <p>Session participante
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="ps" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('sessionsParticipant') }}">Session participant</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#budgets" class="collapsed" aria-expanded="false">
                            <i class="fa fa-usd"></i>
                            <p>Budgets
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="budgets" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="#"><i class="fa fa-list"></i> Budgets</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-plus"></i> Gestion</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#session" class="collapsed" aria-expanded="false">
                            <i class="fa fa-file-text-o"></i>
                            <p>Rapport
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="session" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="#">Session participant</a>
                                </li>
                                <li>
                                    <a href="#">Session d'entrainement</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#evaluation" class="collapsed" aria-expanded="false">
                            <i class="fa fa-question-circle-o"></i>
                            <p>Evaluation
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="evaluation" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="#"><i class="fa fa-thermometer-full" aria-hidden="true"></i> A chaud</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-thermometer-empty" aria-hidden="true"></i> A froid</a>
                                </li>
                            </ul>
                        </div>
                    </li>


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
                        <a class="navbar-brand" href="{{ url('/') }}"> Accueil </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/register') }}">Register</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
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
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="#">Admin</a>
                    </p>
                </div>
            </footer>
        </div>

    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/vendors/jquery-3.1.1.min.js')}}" type="text/javascript"></script> 
    <script src="{{ asset('assets/vendors/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/material.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/vendors/jquery.validate.min.js')}}"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="{{ asset('assets/vendors/moment.min.js')}}"></script>
    <!--  Charts Plugin -->
    <script src="{{ asset('assets/vendors/chartist.min.js')}}"></script>
    <!--  Plugin for the Wizard -->
    <script src="{{ asset('assets/vendors/jquery.bootstrap-wizard.js')}}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets/vendors/bootstrap-notify.js')}}"></script>
    <!-- DateTimePicker Plugin -->
    <script src="{{ asset('assets/vendors/bootstrap-datetimepicker.js')}}"></script>
    <!--  Checkbox, Radio, Switch and Tags Input Plugins -->
    <script src="../assets/js/bootstrap-checkbox-radio-switch-tags.js"></script>
    <!-- Vector Map plugin -->
    <script src="{{ asset('assets/vendors/jquery-jvectormap.js')}}"></script>
    <!-- Sliders Plugin -->
    <script src="{{ asset('assets/vendors/nouislider.min.js')}}"></script>
    <!-- Select Plugin -->
    <script src="{{ asset('assets/vendors/jquery.select-bootstrap.js')}}"></script>
    <!--  DataTables.net Plugin    -->
    <script src="{{ asset('assets/vendors/jquery.datatables.js')}}"></script>
    <!-- Sweet Alert 2 plugin -->
    <script src="{{ asset('assets/vendors/sweetalert/js/sweetalert2.min.js')}}"></script>
    <!--    Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('assets/vendors/jasny-bootstrap.min.js')}}"></script>
    <!--  Full Calendar Plugin    -->
    <script src="{{ asset('assets/vendors/fullcalendar.min.js')}}"></script>
    <!-- TagsInput Plugin -->
    <script src="{{ asset('assets/vendors/jquery.tagsinput.js')}}"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('assets/js/amaze.js')}}"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/demo.js')}}"></script>
    <script type="text/javascript">
        $().ready(function() {
            $('#formateur_modal').appendTo("body");
            $('#participant_modal').appendTo("body");
            $('[data-toggle="tooltip"]').tooltip();

            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }

            });


            var table = $('#datatables').DataTable();

            // Edit record
            table.on('click', '.edit', function() {
                $tr = $(this).closest('tr');

                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function(e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function() {
                alert('You clicked on Like button');
            });

            $('.card .material-datatables label').addClass('form-group');

                demo.checkFullPageBackgroundImage();
                setTimeout(function() {
                    // after 1000 ms we add the class animated to the login/register card
                    $('.card').removeClass('card-hidden');
                }, 700)
            });
            demo.initFormExtendedDatetimepickers();
    </script>

    @yield('javascript')

</body>
</html>

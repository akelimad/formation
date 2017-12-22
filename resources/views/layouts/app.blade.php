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
    <link href="{{ asset('assets/vendors/select2/select2.min.css')}}" rel="Stylesheet" >
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

                    <li class="{{ Request::path() == '/' ? 'active' : '' }}" >
                        <a href="{{url('/')}}">
                            <i class="fa fa-tachometer"></i>
                            <p>Tableau de board</p>
                        </a>
                    </li>

                    <li class="{{ Request::path() == 'prestataires' ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#prestataires" class="collapsed" aria-expanded="false">
                            <i class="fa fa-handshake-o"></i>
                            <p>Prestataires
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="prestataires" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('prestataires') }}"><i class="fa fa-list"></i> Prestataires</a>
                                </li>
                                <li>
                                    <a href="{{ url('prestataires/create') }}"><i class="fa fa-plus"></i> Ajouter</a>
                                </li>
                                <li>
                                    <a href="{{ url('formateurs') }}"><i class="fa fa-list"></i> Formateurs</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="{{ Request::path() == 'cours' ? 'active' : '' }}">
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

                    <li class="{{ Request::path() == 'salles' ? 'active' : '' }}">
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

                    <li class="{{ Request::path() == 'sessions' ? 'active' : '' }}">
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
                                <li>
                                    <a href="{{ url('budgets') }}">Budgets</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="{{ Request::path() == 'budgetsFormation' ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#session" class="collapsed" aria-expanded="false">
                            <i class="fa fa-file-text-o"></i>
                            <p>Rapport
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="session" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('budgetsFormation') }}">Standard</a>
                                </li>
                                <li>
                                    <a href="{{ url('formationUtilisateur') }}">Personnalisé</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="{{ Request::path() == 'evaluations' ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#evaluation" class="collapsed" aria-expanded="false">
                            <i class="fa fa-question-circle-o"></i>
                            <p>Evaluation
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="evaluation" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('evaluations') }}"><i class="" aria-hidden="true"></i> Evaluations</a>
                                </li>
                                <li>
                                    <a href="{{ url('evaluations/create') }}"><i class="" aria-hidden="true"></i> Ajouter</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="{{ Request::path() == 'utilisateurs' ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#users" class="collapsed" aria-expanded="false">
                            <i class="fa fa-users"></i>
                            <p>Administration
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="users" role="navigation" aria-expanded="false" style="height: 0px;">
                            <ul class="nav">
                                <li>
                                    <a href="{{ url('utilisateurs') }}"><i class="" aria-hidden="true"></i> Utilisateurs</a>
                                </li>
                                <li>
                                    <a href="#"><i class="" aria-hidden="true"></i> Droits d'accès</a>
                                </li>
                                <li>
                                    <a href="{{ url('register') }}"><i class="" aria-hidden="true"></i> Ajouter </a>
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
    <script src="{{ asset('assets/vendors/bootstrapValidator.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/material.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
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
    <!-- DateTimePicker Plugin -->
    <script src="{{ asset('assets/vendors/bootstrap-datetimepicker.js')}}"></script>
    <!--  Checkbox, Radio, Switch and Tags Input Plugins -->
    <script src="{{ asset('assets/js/bootstrap-checkbox-radio-switch-tags.js')}}"></script>
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
    <!-- select2 Plugin -->
    <script src="{{ asset('assets/vendors/select2/select2.min.js')}}"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="{{ asset('assets/js/amaze.js')}}"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/demo.js')}}"></script>
    <script src="{{ asset('assets/js/charts/chartjs-charts.js')}}"></script>
    <script type="text/javascript">
        $().ready(function() {

            // Add new Line
            $(".addLine").click(function(event){
                event.preventDefault()
                var copy = $('#budgets-wrap').find(".form-group:first").clone()
                copy.find('input').val('')
                copy.find('button').toggleClass('addLine deleteLine')
                copy.find('button>i').toggleClass('fa-plus fa-minus')
                var uid = uuidv4()
                $.each(copy.find('input'), function(){
                    var name = $(this).attr('name')
                    $(this).attr('name', name.replace('[0]', '['+uid+']'))
                })
                $('#budgets-wrap').append(copy)
            })
            $('#budgets-wrap').on('click', '.deleteLine', function(){
                $(this).closest('.form-group').remove();
            });

            // Add new Line
            $(".addLine").click(function(event){
                event.preventDefault()
                var copy = $('#questions-wrap').find(".form-group:first").clone()
                copy.find('input').val('')
                copy.find('button').toggleClass('addLine deleteLine')
                copy.find('button>i').toggleClass('fa-plus fa-minus')
                var uid = uuidv4()
                $.each(copy.find('input'), function(){
                    var name = $(this).attr('name')
                    $(this).attr('name', name.replace('[0]', '['+uid+']'))
                })
                $('#questions-wrap').append(copy)
            })
            $('#questions-wrap').on('click', '.deleteLine', function(){
                $(this).closest('.form-group').remove();
            });



            function uuidv4() {
                return ([1e7]+-1e3).replace(/[018]/g, c =>
                    (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
                )
            }


            $('.js-example-basic-multiple').select2({
                multiple: true,
                width: "100%",
                'placeholder':'Selectionnez',
            });


            $('#formateur_modal').appendTo("body");
            $('#participant_modal').appendTo("body");
            $('#questionnaire_modal').appendTo("body");
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
                //alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
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

            var MAX_OPTIONS = 30;
            $('#surveyForm').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    question: {
                        validators: {
                            notEmpty: {
                                message: 'The question required and cannot be empty'
                            }
                        }
                    },
                    'option[]': {
                        validators: {
                            notEmpty: {
                                message: 'The option required and cannot be empty'
                            },
                            stringLength: {
                                max: 100,
                                message: 'The option must be less than 100 characters long'
                            }
                        }
                    }
                }
            })

            // Add button click handler
            .on('click', '.addButton', function() {
                var $template = $('#optionTemplate'),
                    $clone    = $template
                                    .clone()
                                    .removeClass('hide')
                                    .removeAttr('id')
                                    .insertBefore($template),
                    $option   = $clone.find('[name="option[]"]');

                // Add new field
                $('#surveyForm').bootstrapValidator('addField', $option);
            })

            // Remove button click handler
            .on('click', '.removeButton', function() {
                var $row    = $(this).parents('.form-group'),
                    $option = $row.find('[name="option[]"]');

                // Remove element containing the option
                $row.remove();

                // Remove field
                $('#surveyForm').bootstrapValidator('removeField', $option);
            })

            // Called after adding new field
            .on('added.field.bv', function(e, data) {
                // data.field   --> The field name
                // data.element --> The new field element
                // data.options --> The new field options

                if (data.field === 'option[]') {
                    if ($('#surveyForm').find(':visible[name="option[]"]').length >= MAX_OPTIONS) {
                        $('#surveyForm').find('.addButton').attr('disabled', 'disabled');
                    }
                }
            })

            // Called after removing the field
            .on('removed.field.bv', function(e, data) {
               if (data.field === 'option[]') {
                    if ($('#surveyForm').find(':visible[name="option[]"]').length < MAX_OPTIONS) {
                        $('#surveyForm').find('.addButton').removeAttr('disabled');
                    }
                }
            });


            $('.realise').keyup(function(){
                var prevu = parseInt($(".prevu").val());
                var realise = parseInt($(".realise").val());
                if($('.realise').val().length === 0){
                    $('.ajustement').val(0);  
                }else{
                    $('.ajustement').val(prevu - realise);  
                }
            });

    </script>

    @yield('javascript')

</body>
</html>

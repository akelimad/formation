<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8" >
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.html" >
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >

    <title>
        {{ Request::is('questionnaire*') ? 'Questionnaire' : 'Authentification' }} | Plateforme de gestion de formation
    </title>

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
    <style>
        body{
            overflow: hidden;
        }
        .main-panel > .content{
            padding: 0
        }
    </style>
</head>
<body id="app-layout">
    <div class="wrapper login">
        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
            <!-- <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="#">Admin</a>
                    </p>
                </div>
            </footer> -->
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

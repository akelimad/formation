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
    <!--     custom style css     -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
    <div class="wrapper-survey">
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>

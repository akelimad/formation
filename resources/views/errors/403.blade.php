<!DOCTYPE html>
<html>
    <head>
        <title>Erreur 403 | Vous n'êtes pas autorisés d'accéder à cette page</title>
        <meta charset="UTF-8">
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" >
        <style>
            html, body {
                height: 100%;
            }

            body {
                background: url({{url('assets/img/403-error.jpg')}}) no-repeat center;
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: arial;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <!-- <div class="title"><i class="fa fa-ban fa-3x"></i> Vous êtes pas autorisés d'accéder ! </div> -->
            </div>
            <a href="{{url('/')}}" class="btn btn-primary"> Retour </a>
        </div>
    </body>
</html>

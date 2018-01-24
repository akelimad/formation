<!DOCTYPE html>
<html>
    <head>
        <title>Erreur 404 | Page introuvable</title>
        <meta charset="UTF-8">
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" >
        <style>
            html, body {
                height: 100%;
            }

            body {
                background: url({{asset('assets/img/404.png')}}) no-repeat center;
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
                vertical-align: bottom;
            }

            .content {
                text-align: center;
                display: inline-block;
                position: fixed;
                width: 100%;
                height: 100%;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <a href="{{url('/')}}">
            <div class="container">
                <div class="content">
                    <!-- <div class="title"><i class="fa fa-ban fa-3x"></i> Aucune page trouvée ! </div> -->
                </div>
            </div>
        </a>
    </body>
</html>

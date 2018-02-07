<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title>Inscription à la session</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" >
        <style>
            .container{
                max-width: 60%;
                margin: auto;
            }
            .panel{
                background: white;
                border: 1px solid #d8d4d4;
            }
            .panel-body{
                padding: 2em;
            }
            .name{
                text-align: center;
                font-size: 17px;
                color: #f15619;
            }
            a.btn-primary{
                background: #0070ff;
                padding: 11px;
                color: white;
                border-radius: 20px;
                text-decoration: none;
                text-align: center;
            }
            p{
                font-size: 15px;
                font-family: 'verdana'; 
                text-align: center;
                color: #505050;
                margin: 0.8em;
            }
            p.btn{
                margin: 2em;
            }
            .panel-heading{
                padding: 1em;
                background: #00b7ff;
                font-size: 30px;
                color: white;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="container">
                <div class="panel panel-info">
                    <div class="panel-heading text-center"> Inscription à la session: {{ $session }} </div>
                    <div class="panel-body"> 
                        <div class="col-md-12">
                            <div class="card">
                                <div class="content">
                                    <p class="text-center name">Bonjour {{ $civilite }}. <b>{{ $participant }},</b> </p>

                                    <p>Vous êtes inscris pour la formation : <b>{{ $session }}</b> .qui commencera le <b>{{ Carbon\Carbon::parse($start)->format('d/m/Y H:i')}}</b> et se terminera le <b>{{ Carbon\Carbon::parse($end)->format('d/m/Y H:i')}}</b>, la formation aura lieu à <b>{{ $lieu }}</b> </p>

                                    <p>Vous pouvez consulter le détail de la formation sur le lien : <a href="{{ url('/login') }}">{{ url('/login') }}</a></p>

                                    <p class="btn"><a href="{{ url('/login') }}" class="btn-primary">Visiter votre espace</a></p>

                                    <p>Votre email : {{ $email }}</p>

                                    <p>Mot de passe : {{ $password }}</p>
                                    <hr>
                                    <p>Nous vous remercions pour votre contribution</p>
                                    <p>Cordialement</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title>Evaluation de la session</title>
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
                    <div class="panel-heading text-center"> Evaluation de la session: {{$session}}</div>
                    <div class="panel-body"> 
                        <div class="col-md-12">
                            <div class="card">
                                <div class="content">
                                    <p class="text-center name">Bonjour Mme/Mr. <b>{{ $participant }},</b> </p>
                                    <p>
                                        Dans le cadre de l’évaluation <b>{{$evaluation_type}}</b> de la session de formation <b>{{$session}}</b>, vous demandons de bien vouloir remplir le questionnaire ci-après <br>
                                        <a href="{{ url('/questionnaire/'.$evaluation_id.'/'.$token.'/questions') }}">
                                            {{ url('/questionnaire/'.$evaluation_id.'/'.$token.'/questions') }}
                                        </a>
                                    </p>
                                    <p class="btn"><a href="{{ url('/questionnaire/'.$evaluation_id.'/'.$token.'/questions') }}" class="btn-primary"> Consulter le questionnaire </a></p>
                                    <hr>
                                    <p> Cordialement </p>
                                    <p> Direction RH </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>



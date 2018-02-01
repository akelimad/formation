<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title></title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <style>
            .content{
                /*background: #f7f7f7;*/
                /*padding: 2em;*/
            }
            p{
                font-size: 17px;
                font-family: 'Lato'; 
            }
        </style>
    </head>
    <body>
        <div class="content">
            <p>Bonjour M. {{$participant}}, </p>
            <p>
                Dans le cadre de l’évaluation {{$evaluation_type}} de la session de formation {{$session}}, 
                nous vous demandons de bien vouloir remplir le questionnaire ci-après <br>
                <a href="{{ url('/questionnaire/'.$evaluation_id.'/'.$token.'/questions') }}">
                    {{ url('/questionnaire/'.$evaluation_id.'/'.$token.'/questions') }}
                </a>
            </p>
            <p>Nous vous remercions pour votre contribution</p>
            <p>Cordialement</p>
        </div>
    </body>
</html>

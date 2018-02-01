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
            <p>Bonjour M. {{ $participant }}, </p>

            <p>Nous vous remercions pour l’intérêt que vous portez à notre institution.</p>

            <p>Votre inscription à la session {{ $session }} a bien été enregistrée.</p>

            <p>Nous vous rappelons vos données de connexion à votre espace:</p>

            <p>le lien: <a href="{{ url('/login') }}">{{ url('/login') }}</a></p>

            <p>Votre email : {{ $email }}</p>

            <p>Mot de passe : {{ $password }}</p>

            <p>Ces identifiants vous permettront d'accéder à votre espace membre et de voir les sessions auquelles vous êtes invités</p>
            
            <p>Nous vous remercions pour votre contribution</p>
            <p>Cordialement</p>
        </div>
    </body>
</html>


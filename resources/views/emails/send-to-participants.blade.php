<p>Bonjour M. {{$participant}} </p>

<p>
    Dans le cadre de l’évaluation {{$evaluation_type}} de la session de formation {{$session}}, 
    nous vous demandons de bien vouloir remplir le questionnaire ci-après
    <a href="{{ url('/questionnaire/'.$evaluation_id.'/'.$token.'/questions') }}">
        {{ url('/questionnaire/'.$evaluation_id.'/'.$token) }}
    </a>
</p>
<p>Nous vous remercions pour votre contribution</p>
<p>Cordialement</p>


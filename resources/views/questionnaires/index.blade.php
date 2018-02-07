@extends('layouts.survey')
@section('pageTitle', 'Questionnaire')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card questionnaire">
                <form action="@if(isset($token)) {{ url('questionnaire/'.$eval_id.'/'.$token) }} @endif" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title text-center"> Fiche d'évaluation </h4>
                        <p class="descSurvey"> Vous venez de participer une formation sur <b>{{ $session->nom }}</b> organisé par Espoir Maroc. afin de nous permettre de juger de la qualité de cette formation et de la faire évoluer, nous vous serrions reconnaissants de bien vouloir compléter le questionnaire suivant.  </p>
                        <p> <i class="fa fa-graduation-cap"></i> Intitulé de la formation: {{ $session->cour->titre }} </p>
                        <p> <i class="fa fa-calendar"></i> Dates: {{ Carbon\Carbon::parse($session->start)->format('d/m/Y H:i')}} - {{ Carbon\Carbon::parse($session->end)->format('d/m/Y H:i')}} </p>
                        <div class="toolbar">
                            Merci de rensigner votre niveau de satisfaction concernant les critères suivants.
                        </div>

                        <div class="row">
                            @if(count($questions)>0)
                                @foreach($questions as $key => $question)
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <p>{{$key +1 }} <i class="fa fa-caret-right"></i> {{$question->titre}}</p>
                                                <input type="hidden" name="questionsIds[]" value="{{$question->id}}">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="reponses[]" class="btn btn-primary" required="">
                                                    <option selected value="">=== Selectionnez ===</option>
                                                    <option value="5">Fortement satisfait</option>
                                                    <option value="4">Satisfait</option>
                                                    <option value="3">Neutre</option>
                                                    <option value="2">Pas satisfait</option>
                                                    <option value="1">Fortement insatisfait</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center">
                                    @if(isset($token))
                                        <button type="submit" class="btn btn-info btn-fill text-center">Envoyer  <i class="fa fa-long-arrow-right"></i></button>
                                    @else
                                        <a href="{{url('evaluations')}}" class="btn btn-info btn-fill text-center"><i class="fa fa-long-arrow-left"></i> Retour</a>
                                    @endif
                                </div>
                            @else
                                <div class="form-group">
                                    <h4> Cette évaluation n'a pas encore de questionnaire !  <a href="{{ url('evaluations') }}" class="btn btn-primary"> <i class="fa fa-long-arrow-left"></i> Retour</a></h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
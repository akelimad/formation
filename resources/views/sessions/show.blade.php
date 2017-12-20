@extends('layouts.app')

@section('content') 
    <div class="content details">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="card">
                        <a href="{{url('sessions')}}"> <i class="fa fa-reply fa-3x"></i> </a>
                        <h3 class="detail-title h3 text-center"> Details de la session: {{$s->nom}}</h3>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 mb40">
                                <div class="item">
                                    <p> Participants: </p>
                                    @foreach($s->participants as $par)
                                        <span class="btn btn-primary">{{ $par->nom }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-5 mb40">
                                <div class="item">
                                    <p> Cours: <span class="label label-success">{{$s->cour->titre}}</span> </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-5 mb40">
                                <div class="item">
                                    <p> Formateur: <span class="label label-success"> {{$s->formateur->nom}} </span></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-5 mb40">
                                <div class="item">
                                    <p> Salle: <span class="label label-success">{{$s->salle->numero}} </span></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-5 mb40">
                                <div class="item">
                                    <p> Satatut: <span class="label label-success">{{$s->statut}} </span> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
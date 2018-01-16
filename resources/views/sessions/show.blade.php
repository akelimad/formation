@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                    <div class="content">
                        <a href="{{url('sessions')}}" title="Retour"> <i class="fa fa-reply fa-3x"></i></a>
                        <h4 class="title">Details de la session <a href="{{url('sessions/'.$s->id.'/edit')}}"> {{$s->nom}} </a> </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom </label>
                                    <p class="form-control"> {{ $s->nom }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cours </label>
                                            <p class="form-control"> {{ $s->cour->titre }} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Formateur </label>
                                            <p class="form-control"> {{ $s->formateur->nom }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Date de début  </label>
                                    <p class="form-control"> {{ Carbon\Carbon::parse($s->start)->format('d/m/Y H:i') }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Date de fin  </label>
                                    <p class="form-control"> {{ Carbon\Carbon::parse($s->end)->format('d/m/Y H:i') }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Lieu</label>
                                    <p class="form-control"> {{$s->lieu}} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Methode </label>
                                            <p class="form-control"> {{$s->methode}} </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Statut </label>
                                            <p class="form-control"> {{$s->statut}} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating participants">
                                    <label class="control-label">Participants présents</label>
                                    @foreach ($p_presents as $par)
                                        <span class="badge">{{$par->nom}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Salle </label>
                                    <p class="form-control"> {{$s->salle->numero}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Description</label>
                                    <p class="form-control"> {{$s->description}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection


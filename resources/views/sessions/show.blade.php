@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="content">
                        <a href="{{url('sessions')}}" title="Retour"> <i class="fa fa-reply fa-3x"></i></a>
                        <h4 class="title">Details de la session</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Titre"  value="{{$s->nom}}" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cours </label>
                                            <select class="selectpicker" name="cour" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" required="">
                                                <option disabled selected value="">{{$s->cour->titre}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Formateur </label>
                                            <select class="selectpicker" name="formateur" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" required="">
                                                <option disabled selected value="">{{$s->formateur->nom}}</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Date de début  </label>
                                    <input type="text" name="start" data-date-format="DD/MM/YYYY HH:mm" class="form-control datepicker" required="" value="{{ Carbon\Carbon::parse($s->start)->format('d/m/Y H:i') }}" disabled="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Date de fin  </label>
                                    <input type="text" name="end" data-date-format="DD/MM/YYYY HH:mm" class="form-control datepicker" required="" value="{{ Carbon\Carbon::parse($s->end)->format('d/m/Y H:i') }}" disabled="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Lieu</label>
                                    <input class="form-control" name="lieu" type="text" placeholder="Lieu" value="{{$s->lieu}}"disabled="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Methode </label>
                                            <select class="selectpicker" name="methode" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                                <option disabled selected>{{$s->methode}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Statut </label>
                                            <select class="selectpicker" name="statut" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                                <option disabled selected>{{$s->statut}}</option>
                                            </select>
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
                                    <select class="selectpicker" required="" name="salle" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected>{{$s->salle->numero}}</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Description" rows="3" disabled="">{{$s->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


@endsection


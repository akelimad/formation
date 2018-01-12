@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                    <div class="content">
                        <a href="{{url('prestataires')}}" title="Retour"> <i class="fa fa-reply fa-3x"></i></a>
                        <h4 class="title">Détails du prestataire <a href="{{url('prestataires/'.$p->id.'/edit')}}">{{$p->nom}}</a></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom complet  </label>
                                    <p class="form-control"> {{ $p->nom }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Code </label>
                                    <p class="form-control"> {{ $p->code }} </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Type </label>
                                    <p class="form-control"> {{ $p->type }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Spécialité </label>
                                    <p class="form-control"> {{ $p->specialite }} </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">N° de téléphone </label>
                                    <p class="form-control"> {{ $p->tel }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Adresse electronique </label>
                                    <p class="form-control"> {{ $p->email }} </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">N° de Fax </label>
                                    <p class="form-control"> {{ $p->fax }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Personne de premier contact </label>
                                    <p class="form-control"> {{ $p->personne_contacter }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Type d'entreprise</label>
                                    <p class="form-control"> {{ $p->type_entreprise }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Qualification</label>
                                    <p class="form-control"> {{ $p->qualification }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Commentaire</label>
                                    <p class="form-control"> {{ $p->commentaire }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
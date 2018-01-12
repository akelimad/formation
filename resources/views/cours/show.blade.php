@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="content">
                    <a href="{{url('cours')}}" title="Retour"> <i class="fa fa-reply fa-3x"></i></a>
                    <h4 class="title">Détails du cours <a href="{{url('cours/'.$c->id.'/edit')}}"> {{ $c->titre }} </a> </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Titre </label>
                                <p class="form-control"> {{ $c->titre }} </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Coordinateur  </label>
                                <p class="form-control"> {{ $c->coordinateur }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Devise </label>
                                        <p class="form-control"> {{ $c->devise }} </p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Budget </label>
                                        <p class="form-control"> {{ $c->budget }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Durée(Nombre de jour) </label>
                                <p class="form-control"> {{ $c->duree }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group label-floating">
                                <label class="control-label">Description</label>
                                <p class="form-control"> {{ $c->description }} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
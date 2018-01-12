@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                    <div class="content">
                        <a href="{{url('salles')}}" title="Retour"> <i class="fa fa-reply fa-3x"></i></a>
                        <h4 class="title">Détails de la salle <a href="{{url('salles/'.$s->id.'/edit')}}">{{$s->numero}}</a></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Numéro<star>*</star></label>
                                    <p class="form-control"> {{ $s->numero }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Capacité<star>*</star></label>
                                    <p class="form-control"> {{ $s->capacite }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Equipements</label>
                                    <p class="form-control"> {{ $s->equipements }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Photo</label>
                                    <img src="{{url('sallePhotos/'.$s->photo)}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Disposition</label>
                                    <p class="form-control"> {{ $s->disposition }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
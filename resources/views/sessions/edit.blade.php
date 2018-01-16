@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form class="allInputsFormValidation" action="{{ url('sessions/'.$s->id) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="content">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <span><strong>Attention !</strong> {{ $error }}</span>
                                </div>
                            @endforeach
                        @endif
                        <h4 class="title">Modifier une session</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom<star>*</star> </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Titre"  value="{{$s->nom}}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cours<star>*</star> </label>
                                            <select class="selectpicker" name="cour" data-style="btn btn-primary btn-round" title="Select" data-size="7" required="">
                                                <option disabled selected value="">-- select --</option>
                                                @foreach ($cours as $cour)
                                                    <option value="{{ $cour->id}}" {{$cour->id == $s->cour->id ? 'selected':''}} > {{ $cour->titre }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Formateur<star>*</star> </label>
                                            <select class="selectpicker" name="formateur" data-style="btn btn-primary btn-round" title="Select" data-size="7" required="">
                                                <option disabled selected value="">-- select --</option>
                                                @foreach ($formateurs as $formateur)
                                                    <option value="{{ $formateur->id }}" {{$formateur->id == $s->formateur->id ? 'selected':''}} > {{ $formateur->nom }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Date de début <star>*</star> </label>
                                    <input type="text" name="start" data-date-format="DD/MM/YYYY HH:mm" class="form-control datepicker" required="required" value="{{ Carbon\Carbon::parse($s->start)->format('d/m/Y H:i') }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Date de fin <star>*</star> </label>
                                    <input type="text" name="end" data-date-format="DD/MM/YYYY HH:mm" class="form-control datepicker" required="required" value="{{ Carbon\Carbon::parse($s->end)->format('d/m/Y H:i') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Lieu <star>*</star></label>
                                    <input class="form-control" name="lieu" type="text" placeholder="Lieu" value="{{$s->lieu}}" required="required" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Methode <star>*</star></label>
                                            <select class="selectpicker" name="methode" data-style="btn btn-primary btn-round" title="Select" data-size="7" required="required">
                                                <option disabled selected>-- select --</option>
                                                <option value="Salle de classe" {{$s->methode == 'Salle de classe' ? 'selected':''}} >Salle de classe</option>
                                                <option value="Autoformation" {{$s->methode == 'Autoformation' ? 'selected':''}} >Autoformation</option>
                                                <option value="WebEx" {{$s->methode == 'WebEx' ? 'selected':''}} >WebEx</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Statut <star>*</star></label>
                                            <select class="selectpicker" name="statut" data-style="btn btn-primary btn-round" title="Select" data-size="7" required="required">
                                                <option disabled selected>-- select --</option>
                                                <option value="Aprobation en attente" {{$s->statut == 'Aprobation en attente' ? 'selected': ''}} >Aprobation en attente</option>
                                                <option value="Programmé" {{$s->statut == 'Programmé' ? 'selected': ''}} >Programmé</option>
                                                <option value="Terminé" {{$s->statut == 'Terminé' ? 'selected': ''}} >Terminé</option>
                                                <option value="Annulé" {{$s->statut == 'Annulé' ? 'selected': ''}} >Annulé</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating participants">
                                    <label class="control-label">Participants prévus</label>
                                    @foreach ($s->participants as $par)
                                        @if(in_array($par->id, $prevus_ids))
                                        <span class="badge">{{$par->nom}}</span>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="form-group label-floating participants">
                                    <label class="control-label">Participants présents <star>*</star></label>
                                   
                                    <select class="js-example-basic-multiple form-control" name="participants[]" multiple="multiple" required="required">
                                        @foreach ($participants as $p)
                                            <option value="{{$p->id}}" @if (in_array($p->id, $present_ids)) selected @endif > {{$p->nom}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Salle <star>*</star></label>
                                    <select class="selectpicker" required="required" name="salle" data-style="btn btn-primary btn-round" title="Select" data-size="7">
                                        @foreach ($salles as $salle)
                                            <option value="{{ $salle->id }}" {{$salle->id == $s->salle->id ? 'selected':''}} > {{ $salle->numero }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Description" rows="3">{{$s->description}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="category form-category"><star>*</star> Champ obligatoire</div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-rose btn-fill btn-wd" value="Sauvegarder">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


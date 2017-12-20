@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="LoginValidation" action="{{ url('sessions') }}" method="post">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter une session</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom<star>*</star> </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Titre" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Cours<star>*</star> </label>
                                            <select class="selectpicker" name="cour" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" required="">
                                                <option disabled selected value="">-- select --</option>
                                                @foreach ($cours as $cour)
                                                    <option value="{{ $cour->id }}"> {{ $cour->titre }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Formateur<star>*</star> </label>
                                            <select class="selectpicker" name="formateur" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" required="">
                                                <option disabled selected value="">-- select --</option>
                                                @foreach ($formateurs as $formateur)
                                                    <option value="{{ $formateur->id }}"> {{ $formateur->nom }} </option>
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
                                    <label class="label-control">Date de début <star>*</star></label>
                                    <input type="text" name="start" data-date-format="DD/MM/YYYY" class="form-control datepicker" required="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Date de fin</label>
                                    <input type="text" name="end" data-date-format="DD/MM/YYYY" class="form-control datepicker" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Lieu</label>
                                    <input class="form-control" name="lieu" type="text" placeholder="Lieu" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Methode </label>
                                            <select class="selectpicker" name="methode" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                                <option disabled selected>-- select --</option>
                                                <option value="Salle de classe">Salle de classe</option>
                                                <option value="Autoformation">Autoformation</option>
                                                <option value="WebEx">WebEx</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Statut </label>
                                            <select class="selectpicker" name="statut" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                                <option disabled selected>-- select --</option>
                                                <option value="Aprobation en attente">Aprobation en attente</option>
                                                <option value="Programmé">Programmé</option>
                                                <option value="Terminé">Terminé</option>
                                                <option value="Annulé">Annulé</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating participants">
                                    <label class="control-label">Participants</label>
                                    <select class="js-example-basic-multiple form-control" name="participants[]" multiple="multiple">
                                        @foreach ($participants as $p)
                                            <option value="{{$p->id}}">{{$p->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Salle <star>*</star></label>
                                    <select class="selectpicker" required="" name="salle" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected>-- select --</option>
                                        @foreach ($salles as $salle)
                                            <option value="{{ $salle->id }}"> {{ $salle->numero }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Description" rows="3"></textarea>
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


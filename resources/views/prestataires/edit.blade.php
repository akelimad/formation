@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="LoginValidation" action="{{ url('prestataires/'.$p->id) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Modifier un prestataire</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom complet<star>*</star> </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Nom" value="{{$p->nom}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Code </label>
                                    <input type="text" name="code" class="form-control"  placeholder="Code" value="{{$p->code}}" readonly="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Type</label>
                                    <select class="selectpicker" name="type" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected>-- select --</option>
                                        <option value="Cabinet" {{$p->type == 'Cabinet' ? 'selected' : ''}}>Cabinet</option>
                                        <option value="Institution Etatique" {{$p->type == 'Institution Etatique' ? 'selected' : ''}}>Institution Etatique</option>
                                        <option value="Ecole" {{$p->type == 'Ecole' ? 'selected' : ''}}>Ecole</option>
                                        <option value="Autres" {{$p->type == 'Autres' ? 'selected' : ''}}>Autres</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Spécialité</label>
                                    <select class="selectpicker" name="specialite" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected>-- select --</option>
                                        <option value="RH" {{$p->specialite == 'RH' ? 'selected' : ''}}>RH</option>
                                        <option value="Informatique" {{$p->specialite == 'Informatique' ? 'selected' : ''}}>Informatique</option>
                                        <option value="Bureautique" {{$p->specialite == 'Bureautique' ? 'selected' : ''}}>Bureautique</option>
                                        <option value="Soft Skills" {{$p->specialite == 'Soft Skills' ? 'selected' : ''}}>Soft Skills</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">N° de téléphone</label>
                                    <input class="form-control" name="tel" type="text" placeholder="N° de téléphone" value="{{$p->tel}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Adresse electronique</label>
                                    <input class="form-control" name="email" type="email" placeholder="Adresse electronique"  value="{{$p->email}}" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">N° de Fax</label>
                                    <input class="form-control" name="fax" type="text" placeholder="N° de Fax" value="{{$p->fax}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Personne de premier contact</label>
                                    <input class="form-control" name="personne_contacter" type="text" placeholder="Personne de premier contact" value="{{$p->personne_contacter}} " />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Type d'entreprise</label>
                                    <input class="form-control" name="type_entreprise" type="text" placeholder="Type d'entreprise" value="{{$p->type_entreprise}}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Qualification</label>
                                    <input class="form-control" name="qualification" type="text" placeholder="Personne de premier contact" value="{{$p->qualification}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Commentaire</label>
                                    <textarea class="form-control" name="commentaire" placeholder="Commentaire" rows="3">{{$p->commentaire}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="category form-category">
                            <star>*</star> Champ obligatoire</div>
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
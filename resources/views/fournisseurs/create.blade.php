@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="LoginValidation" action="{{ url('fournisseurs') }}" method="post">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter un prestataire</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom<star>*</star> </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Nom" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Code </label>
                                    <input type="text" name="code" class="form-control"  placeholder="Code" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Type</label>
                                    <select class="selectpicker" name="type" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected>-- select --</option>
                                        <option value="Cabinet">Cabinet</option>
                                        <option value="Institution Etatique">Institution Etatique</option>
                                        <option value="Ecole">Ecole</option>
                                        <option value="Autres">Autres</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Spécialité</label>
                                    <select class="selectpicker" name="specialite" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected>-- select --</option>
                                        <option value="RH">RH</option>
                                        <option value="Informatique">Informatique</option>
                                        <option value="Bureautique">Bureautique</option>
                                        <option value="Soft Skills">Soft Skills</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">N° de téléphone</label>
                                    <input class="form-control" name="tel" type="text" placeholder="N° de téléphone" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Adresse electronique</label>
                                    <input class="form-control" name="email" type="text" placeholder="Adresse electronique" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">N° de Fax</label>
                                    <input class="form-control" name="fax" type="text" placeholder="N° de Fax" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Personne de premier contact</label>
                                    <input class="form-control" name="personne_contacter" type="text" placeholder="Personne de premier contact" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Commentaire</label>
                                    <textarea class="form-control" name="commentaire" placeholder="Commentaire" rows="3"></textarea>
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
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="allInputsFormValidation" action="{{ url('prestataires') }}" method="post" novalidate="novalidate">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter un prestataire</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom complet <star>*</star> </label>
                                    <input class="form-control" name="nom" type="text" required="required" placeholder="Nom" aria-required="required"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Code </label>
                                    <input type="text" name="code" class="form-control"  placeholder="Code" value="{{$code}}" readonly="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Type <star>*</star></label>
                                    <select class="selectpicker" name="type" data-style="btn btn-primary btn-round" title="== Select ==" data-size="7" required="required">
                                        <option value="Cabinet">Cabinet</option>
                                        <option value="Institution Etatique">Institution Etatique</option>
                                        <option value="Ecole">Ecole</option>
                                        <option value="Autres">Autres</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Spécialité <star>*</star></label>
                                    <select class="selectpicker" name="specialite" data-style="btn btn-primary btn-round" title="== Select ==" data-size="7" required="required">
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
                                    <label class="control-label">N° de téléphone <star>*</star></label>
                                    <input class="form-control" name="tel" type="tel" placeholder="N° de téléphone" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Adresse electronique <star>*</star></label>
                                    <input class="form-control" name="email" type="email" email="true" placeholder="Adresse electronique" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">N° de Fax <star>*</star></label>
                                    <input class="form-control" name="fax" type="text" placeholder="N° de Fax" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Personne de premier contact <star>*</star></label>
                                    <input class="form-control" name="personne_contacter" type="text" placeholder="Personne de premier contact" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Type d'entreprise</label>
                                    <input class="form-control" name="type_entreprise" type="text" placeholder="Type d'entreprise" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Qualification</label>
                                    <input class="form-control" name="qualification" type="text" placeholder="Personne de premier contact" />
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
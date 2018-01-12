@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="allInputsFormValidation" action="{{ url('prestataires/'.$p->id) }}" method="post" novalidate="novalidate">
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
                        <h4 class="title">Modifier un prestataire</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom complet <star>*</star> </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Nom" value="{{$p->nom}}" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Code <star>*</star></label>
                                    <input type="text" name="code" class="form-control"  placeholder="Code" value="{{$p->code}}" readonly="" required="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Type <star>*</star></label>
                                    <select class="selectpicker" name="type" data-style="btn btn-primary btn-round" title=" Select" data-size="7" required="">
                                        <option value="Cabinet" {{$p->type == 'Cabinet' ? 'selected' : ''}}>Cabinet</option>
                                        <option value="Institution Etatique" {{$p->type == 'Institution Etatique' ? 'selected' : ''}}>Institution Etatique</option>
                                        <option value="Ecole" {{$p->type == 'Ecole' ? 'selected' : ''}}>Ecole</option>
                                        <option value="Autres" {{$p->type == 'Autres' ? 'selected' : ''}}>Autres</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="label-control">Spécialité <star>*</star></label>
                                    <select class="selectpicker" name="specialite" data-style="btn btn-primary btn-round" title=" Select" data-size="7" required="">
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
                                    <label class="control-label">N° de téléphone <star>*</star></label>
                                    <input class="form-control" name="tel" type="text" placeholder="N° de téléphone" value="{{$p->tel}}" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Adresse electronique <star>*</star></label>
                                    <input class="form-control" name="email" type="email" placeholder="Adresse electronique"  value="{{$p->email}}" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">N° de Fax <star>*</star></label>
                                    <input class="form-control" name="fax" type="text" placeholder="N° de Fax" value="{{$p->fax}}" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Personne de premier contact <star>*</star></label>
                                    <input class="form-control" name="personne_contacter" type="text" placeholder="Personne de premier contact" value="{{$p->personne_contacter}}" required="required" />
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
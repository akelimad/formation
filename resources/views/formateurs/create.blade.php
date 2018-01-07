@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="LoginValidation" action="{{ url('formateurs') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter un formateur</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom complet
                                        <star>*</star>
                                    </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Nom" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="Interne">Interne</option>
                                        <option value="Externe">Externe</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email</label>
                                    <input class="form-control" name="email" type="email" placeholder="example@gmail.com" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Tel</label>
                                    <input class="form-control" name="tel" type="text" placeholder="06 00 00 00 00" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Qualification</label>
                                    <input class="form-control" name="qualification" type="text" placeholder="Qualification" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Expertise</label>
                                    <input class="form-control" name="expertise" type="text" placeholder="Expertise" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Autres</label>
                                    <textarea name="autres" id="" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Télécharger votre C.V en pièce jointe</label>
                                    <input type="file" name="cv" class="form-control" accept=".docx,.pdf" >    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ">
                                <label class="control-label rating">Rating</label>
                            </div>
                            <div class="col-md-10">
                                <div class="stars quality">
                                    <input class="star star-5-q" id="star-5-q" type="radio" name="rating" value="5" />
                                    <label class="star star-5-q" for="star-5-q" title=" Qualité 5/5"></label>
                                    <input class="star star-4-q" id="star-4-q" type="radio" name="rating" value="4"/>
                                    <label class="star star-4-q" for="star-4-q" title=" Qualité 4/5"></label>
                                    <input class="star star-3-q" id="star-3-q" type="radio" name="rating" value="3"/>
                                    <label class="star star-3-q" for="star-3-q" title=" Qualité 3/5"></label>
                                    <input class="star star-2-q" id="star-2-q" type="radio" name="rating" value="2"/>
                                    <label class="star star-2-q" for="star-2-q" title=" Qualité 2/5"></label>
                                    <input class="star star-1-q" id="star-1-q" type="radio" name="rating" value="1"/>
                                    <label class="star star-1-q" for="star-1-q" title=" Qualité 1/5"></label>
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
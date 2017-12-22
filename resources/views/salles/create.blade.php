@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="LoginValidation" action="{{ url('salles') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter une salle</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Numéro<star>*</star></label>
                                    <input class="form-control" name="numero" type="number" required="true" placeholder="Numero" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Capacité<star>*</star></label>
                                    <input class="form-control" name="capacite" type="number" required="true" placeholder="Capacité" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Equipements</label>
                                    <input class="form-control" name="equipements" type="text" placeholder="Equipements" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Photo</label>
                                    <input type="file" name="photo" class="form-control" accept="image/*" />
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
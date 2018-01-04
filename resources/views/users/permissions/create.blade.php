@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="LoginValidation" action="{{ url('utilisateurs/permissions') }}" method="post">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter un permission</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom(unique)<star>*</star></label>
                                    <input class="form-control" name="name" type="text" required="true" placeholder="create_users" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Le nom affiché</label>
                                    <input class="form-control" name="display_name" type="text" placeholder="ajout d'utilisateurs" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" id="" rows="2" class="form-control" placeholder="description de la permission"></textarea>
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
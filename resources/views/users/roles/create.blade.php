@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="allInputsFormValidation" action="{{ url('utilisateurs/roles') }}" method="post" novalidate="novalidate">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter un rôle</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom(unique)<star>*</star></label>
                                    <input class="form-control" name="name" type="text" required="true" placeholder="unique comme Admin" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Le nom affiché</label>
                                    <input class="form-control" name="display_name" type="text" placeholder="comme Utilisateur Administrateur" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" id="" rows="2" class="form-control" placeholder="description du rôle"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Permissions</label>
                                        @foreach($permissions as $p)
                                            <div class="col-sm-2">
                                                <label class="checkbox">
                                                    <input type="checkbox" data-toggle="checkbox" value="{{$p->id}}" name="permissions[]">{{$p->name}}
                                                </label>
                                            </div>
                                        @endforeach
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
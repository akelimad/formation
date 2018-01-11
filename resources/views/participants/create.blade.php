@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="allInputsFormValidation" action="{{ url('participants') }}" method="post" novalidate="novalidate">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter un participant</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom
                                        <star>*</star>
                                    </label>
                                    <input class="form-control" name="nom" type="text" required="" placeholder="Nom" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email</label>
                                    <input class="form-control" name="email" type="email" required="" placeholder="example@gmail.com" />
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
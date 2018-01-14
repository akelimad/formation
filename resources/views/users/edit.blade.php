@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="allInputsFormValidation" class="form-horizontal" role="form" method="POST" action="{{ url('utilisateurs/'.$user->id) }}">
                    <input type="hidden" name="_method" value="PUT" data-toggle="validator">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title text-center h4">Ajouter un utilisateur</h4>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Nom complet <star>*</star></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required="" value="{{ $user->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label">Addresse email <star>*</star></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required="" >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label">Mot de passe </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-3 control-label">Confirmation </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" data-match="#password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-3 control-label">Rôle <star>*</star></label>

                            <div class="col-md-6">
                                <select name="role" id="role" class="form-control" required="">
                                    <option value="0" disabled="" selected="">=== Selectionnez ===</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{in_array($role->id, $roles_ids) ? 'selected':''}}> {{$role->name}} </option>
                                    @endforeach 
                                </select>

                                @if ($errors->has('roles'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <input type="submit" class="btn btn-rose btn-fill btn-wd" value="Sauvegarder">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
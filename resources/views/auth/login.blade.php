@extends('layouts.basic')

@section('content')

<div class="wrapper wrapper-full-page">
        <div class="full-page login-page"  data-color="blue">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="card card-login card-hidden">
                                    <div class="header text-center">
                                        <h3 class="title">Login</h3>
                                    </div>
                                    <div class="content">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">Address E-Mail</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password">

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <span class="icons"><span class="first-icon fa fa-square"></span><span class="second-icon fa fa-check-square "></span></span>
                                                        <input type="checkbox" name="remember"> Se souvenir de moi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-sign-in"></i> Se connecter
                                                </button>

                                                <!-- <a class="" href="{{ url('/password/reset') }}">Mot de passe oublié ?</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

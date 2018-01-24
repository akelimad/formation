@extends('layouts.basic')

@section('content')

<div class="wrapper wrapper-full-page">
        <div class="full-page login-page"  data-color="blue">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
                            <form id="" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">

                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissable" role="alert">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                            </button>
                                            <span><strong>Erreur !</strong> {{ $error }}</span>
                                        </div>
                                    @endforeach
                                @endif
                                {{ csrf_field() }}
                                <div class="card card-login card-hidden">
                                    <div class="header text-center">
                                        <h3 class="title">Login</h3>
                                    </div>
                                    <div class="content">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">Adresse E-mail</label>
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="col-md-4 control-label">Mot de passe</label>
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <label class="checkbox-wrap">
                                                    <input type="checkbox" name="remember" data-toggle="checkbox"> Se souvenir de moi
                                                    <span class="checkmark"></span>
                                                </label>
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

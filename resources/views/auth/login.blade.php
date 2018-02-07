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
                                    @include('partials.alerts.danger', ['messages' => $errors->all()])
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
                                                <i class="fa fa-eye fa-2x" onclick="showPassword()" style="cursor: pointer;"></i>
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
                                            <div class="col-md-6 col-md-offset-4 text-center">
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

@section('javascript')
    <script>
            function showPassword() {
                var password = document.getElementById("password");;
                if (password.type === "password") {
                    password.type = "text";
                } else {
                    password.type = "password";
                }
            }
        $(function(){
            $(".fa-eye").click(function(){
                $(this).toggleClass("fa-eye fa-eye-slash")
            })
        })

    </script>
@endsection



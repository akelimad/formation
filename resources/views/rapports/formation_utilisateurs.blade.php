@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="surveyForm" action="#" method="post">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Formation par utilisateur</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group label-floating">
                                    <input class="form-control" name="titre" type="text" required="true" placeholder="Nom d'utilisateur" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="submit" value="Rechercher"  class="btn btn-primary" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title"></h4>
                                    </div>
                                    <div class="content">
                                        <div class="chart chart-js-container">
                                            <canvas id="lineChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
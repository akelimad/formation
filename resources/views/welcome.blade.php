@extends('layouts.app')

@section('content')
<div class="container-fluid home">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-stats-up"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Nombre de sessions</p>
                                10
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-receipt"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Nombres de cours</p>
                                8
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                DHS
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Budget</p>
                                1200 DH
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card" style="min-height: 648px">
                <div class="header card-header-text">
                    <h4 class="title">Les participants aux sessions</h4>
                    <!-- <p class="category">New employees on 15th December, 2016</p> -->
                </div>
                <div class="content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Nom complet</th>
                                <th>Email</th>
                                <th>Formation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $p)
                            <tr>
                                <td> {{$p->nom}} </td>
                                <td> {{$p->email}} </td>
                                <td> {{$p->session}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="card" style="min-height: 648px">
                <div class="header card-header-text">
                    <h4 class="title">Les sessions prochaines</h4>
                    <!-- <p class="category">New employees on 15th December, 2016</p> -->
                </div>
                <div class="content table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Nom de session</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sessions as $s)
                            <tr>
                                <td> {{$s->nom}} </td>
                                <td> {{$s->start}} </td>
                                <td> {{$s->end}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

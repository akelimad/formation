@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="content">
                    <h4 class="title">Statistiques</h4>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text-center">Budgets par formation</h4>
                                </div>
                                <div class="content">
                                    <div class="chart chart-js-container">
                                        <canvas id="pieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title text-center">Nombre de formations / an</h4>
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
            </div>
        </div>
    </div>
</div>

@endsection
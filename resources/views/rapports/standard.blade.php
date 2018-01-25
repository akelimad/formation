@extends('layouts.app')
@section('pageTitle', 'Rapports')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content standard">
                    <h4 class="title">Statistiques: standards</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <div class="chart chart-js-container">
                                        <canvas id="budgetsPerMonth"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <div class="chart chart-js-container">
                                        <canvas id="sessionsPerMonth"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <div class="chart chart-js-container">
                                        <canvas id="lineChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <div class="chart chart-js-container">
                                        <canvas id="lineChart3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <div class="chart chart-js-container">
                                        <canvas id="lineChart4"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <div class="chart chart-js-container">
                                        <canvas id="lineChart5"></canvas>
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

@section('javascript')
<script>
    $(function(){
        var budgetsConfig = {
            type: 'line',
            data: {
                labels: [
                    @foreach($budgetsPerMonth as $key => $value)
                        "{!! $key !!}",
                    @endforeach
                ],
                    datasets: [{
                        label: "Total de budgets",
                        backgroundColor: "#FF6384",
                        borderColor: "#FF6384",
                        data: [
                            @foreach($budgetsPerMonth as $key => $value)
                                {{$value}},
                            @endforeach
                        ],
                        fill: false,
                    }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Evolution de budgets par mois'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Mois'
                        },
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Total de budgets'
                        }
                    }]
                }
            }
        };
        var sessionsConfig = {
            type: 'line',
            data: {
                labels: [
                    @foreach($sessionsPerMonth as $key => $value)
                        "{!! $key !!}",
                    @endforeach
                ],
                    datasets: [{
                        label: "Total de sessions",
                        backgroundColor: "#FF6384",
                        borderColor: "#FF6384",
                        data: [
                            @foreach($sessionsPerMonth as $key => $value)
                                {{$value}},
                            @endforeach
                        ],
                        fill: false,
                    }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Nombre de sessions par mois'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Mois'
                        },
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Total de sessions'
                        }
                    }]
                }
            }
        };

        if($('#budgetsPerMonth')[0]){
            var budgetsCanvas = $("#sessionsPerMonth").get(0).getContext("2d");
            var budgetsChart = new Chart(budgetsCanvas, budgetsConfig);
        }
        if($('#sessionsPerMonth')[0]){
            var sessionsCanvas = $("#budgetsPerMonth").get(0).getContext("2d");
            var sessionsChart = new Chart(sessionsCanvas, sessionsConfig);
        }
        if($('#lineChart2')[0]){
            var lineChartCanvas = $("#lineChart2").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, budgetsConfig);
        }
        if($('#lineChart3')[0]){
            var lineChartCanvas = $("#lineChart3").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, budgetsConfig);
        }
        if($('#lineChart4')[0]){
            var lineChartCanvas = $("#lineChart4").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, budgetsConfig);
        }
        if($('#lineChart5')[0]){
            var lineChartCanvas = $("#lineChart5").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, budgetsConfig);
        }
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content standard">
                    <h4 class="title">Statistiques: standards</h4>
                    <!-- <div class="row">
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
                    </div> -->
                    <div class="row">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"></h4>
                                </div>
                                <div class="content">
                                    <div class="chart chart-js-container">
                                        <canvas id="lineChart1"></canvas>
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
        var config = {
            type: 'line',
            data: {
                labels: [
                    @foreach($users_cours as $u)
                        "{{$u->name}}",
                    @endforeach
                ],
                    datasets: [{
                        label: "Nombre de cours",
                        backgroundColor: "#FF6384",
                        borderColor: "#FF6384",
                        data: [
                            @foreach($users_cours as $u)
                                {{$u->total}},
                            @endforeach
                        ],
                        fill: false,
                    }]
                },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Titre descriptif du graph'
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
                            labelString: 'Utilisateur'
                        },
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Nombre de cours'
                        },
                        ticks:{
                            stepSize : 1,
                        }
                    }]
                }
            }
        };

        if($('#lineChart')[0]){
            var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, config);
        }
        if($('#lineChart1')[0]){
            var lineChartCanvas = $("#lineChart1").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, config);
        }
        if($('#lineChart2')[0]){
            var lineChartCanvas = $("#lineChart2").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, config);
        }
        if($('#lineChart3')[0]){
            var lineChartCanvas = $("#lineChart3").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, config);
        }
        if($('#lineChart4')[0]){
            var lineChartCanvas = $("#lineChart4").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, config);
        }
        if($('#lineChart5')[0]){
            var lineChartCanvas = $("#lineChart5").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, config);
        }
    });
</script>
@endsection
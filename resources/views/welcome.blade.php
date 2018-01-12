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
                                {{$countSessions ? $countSessions : 0}}
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
                                {{$countCours ? $countCours : 0}}
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
                        <div class="col-xs-4">
                            <div class="icon-big icon-success text-center">
                                DHS
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="numbers">
                                <p>Budget</p>
                            </div>
                                <span class="badge">Prevu: {{$sommeBudgets[0]->totalPrevu ? $sommeBudgets[0]->totalPrevu : 0 }}</span>
                                <span class="badge">Realisé: {{$sommeBudgets[0]->totalRealise ? $sommeBudgets[0]->totalRealise : 0}}</span>
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
                                <th>Session</th>
                                <!-- <th>Date début</th> -->
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
        <div class="col-sm-12 col-lg-6">
            <div class="card" style="min-height: 648px">
                <div class="header card-header-text">
                    <h4 class="title">Les sessions prochaines</h4>
                </div>
                <div class="content card-padding hommeBarchart">
                    <div class="chart chart-js-container">
                        <canvas id="barChart" style="width: 100%" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        $(function() {
            var barChartData = {
                labels: [
                    @foreach($sessionsPerMonth as $key=>$value)
                    "{{$key}}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Nombre de sessions',
                    backgroundColor: "#FF6384",
                    borderColor: "#FF6384",
                    borderWidth: 1,
                    data: [
                        @foreach($sessionsPerMonth as $key=>$value)
                            {{$value}},
                        @endforeach
                    ]
                }]
            };
            var config = {
                type: 'bar',
                data: barChartData,
                width:320,
                height:520,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Nombre de sessions par mois pour l\'année en cours: '+ (new Date()).getFullYear()
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Les mois'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Le nombre se sessions'
                            },
                            ticks:{
                                stepSize : 1,
                            }
                        }]
                    }
                }
            }
            if($('#barChart')[0]){
                var barChartCanvas = $("#barChart").get(0).getContext("2d");
                barChartCanvas.height = 500;
                var barChart = new Chart(barChartCanvas, config);

            }
        })
    </script>
@endsection

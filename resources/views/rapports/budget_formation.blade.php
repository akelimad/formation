@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <div class="content">
                    <h4 class="title">Statistiques: Budgets par formation</h4>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="card">
                                <div class="content">
                                    <form action="" method="get">
                                        <div class="content">
                                            <div class="col-md-7">
                                                <h4 class="title">choisissez une session pour voir ses budgets</h4>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="session" required="">
                                                    <option disabled selected value="">-- select --</option>
                                                    @foreach ($sessions as $s)
                                                        <option value="{{ $s->id }}" @if(isset($selected) && $selected == $s->id) selected @endif > {{ $s->nom }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> consulter</button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                    @if(isset($session_budgets) && count($session_budgets)>0)
                                        <div class="chart chart-js-container">
                                            <canvas id="pieChart"></canvas>
                                        </div>
                                    @else
                                        <span class="h3 alert-warning">Aucun budget pour cette sessions n'a été trouvé !!!</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="title">Nombre de formations / an</h4>
                            <div class="card">
                                <div class="header">
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

@section('javascript')
<script>
    $(function(){
        @if(isset($session_budgets) && count($session_budgets)>0)
            if($('#pieChart')[0]){
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $("#pieChart").get(0).getContext("2d");

                var config = {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [
                                @foreach($session_budgets as $budget)
                                    {{$budget->realise}},
                                @endforeach
                            ],
                            backgroundColor: [
                                "#FF6384",
                                "#4BC0C0",
                            ],
                            label: 'My dataset' // for legend
                        }],
                        labels: [
                            @foreach($session_budgets as $budget)
                                "{!! $budget->budget !!}",
                            @endforeach
                        ]
                    },
                    options: {
                        responsive: true
                    }
                };
               var myPie = new Chart(pieChartCanvas, config); 
            }
        @endif

        //line 
        var config = {
            type: 'line',
            data: {
                labels: [
                    @foreach($sessions_year as $session)
                        {{$session->year}},
                    @endforeach
                ],
                datasets: [{
                    label: "Nombre de formations",
                    backgroundColor: "#FF6384",
                    borderColor: "#FF6384",
                    data: [
                        @foreach($sessions_year as $session)
                            {{$session->countSessions}},
                        @endforeach
                    ],
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'______'
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
                            labelString: 'Les années'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Nombre de formations'
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
    });
</script>
@endsection
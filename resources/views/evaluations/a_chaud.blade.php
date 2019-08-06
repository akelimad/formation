@extends('layouts.app')
@section('pageTitle', 'Evaluations')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content evaluations-wrap">
                    <div class="row">
                        <div class="col-md-12 header-title">
                            <h4> Statistiques de l'évaluation <span class="alert alert-info">{{ $eval_type }}</span>: {{ $eval_nom }}  pour la session:  <span class="alert alert-info">{{$session_nom}} </span> </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 eh">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"><i class="fa fa-users"></i> Les participants repondus: {{ count($participants_repondus) }}</h4>
                                </div>

                                <div class="content card-padding">
                                    <div class="">
                                        <ul class="list-unstyled">
                                            @foreach($participants_repondus as $p)
                                                <span class="badge" title="{{ $p->email }}">{{$p->name}}</span>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 eh">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"><i class="fa fa-users"></i> Les participants non repondus: {{ count($participants_nn_repondus) }}</h4>
                                </div>
                                <div class="content card-padding">
                                    <div class="">
                                        <ul class="list-unstyled">
                                            @foreach($participants_nn_repondus as $p)
                                                <span class=" badge">{{$p}}</span>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form action="{{url('evaluations/'.$eval_id.'/'.$eval_type)}}" method="get">
                            <div class="content">
                                <div class="col-md-5">
                                    <h4 class="title"><i class="fa fa-filter"></i> Choisissez un participant pour voir ses réponses</h4>
                                </div>
                                <div class="col-md-3">
                                    <select class="selectpicker" name="participant" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" required="">
                                        <option disabled selected value="">-- select --</option>
                                        @foreach ($participants_repondus as $p)
                                            <option value="{{ $p->id }}" @if ($selected == $p->id) selected='selected' @endif > {{ $p->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Consulter</button>
                                    <a href="{{ url('evaluations/'.$eval_id.'/'.$eval_type) }}" class="btn btn-primary">
                                        <i class="fa fa-refresh"></i> Actualiser
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card evaluations">
                                <div class="header">
                                    <h4 class="title"><i class="fa fa-check"></i> Les réponses par chaque question</h4>
                                </div>
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="content card-padding">
                                        <div class="chart chart-js-container">
                                            <canvas id="densityChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="labelReponses">
                                        <span class="label label-success">1. Fortement insatisfait</span>
                                        <span class="label label-info">2. Pas satisfait</span>
                                        <span class="label label-default">3. Neutre</span>
                                        <span class="label label-warning">4. Satisfait</span>
                                        <span class="label label-danger">5. Fortement satisfait</span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"><i class="fa fa-info-circle"></i> La note globale: 
                                        {{ $note }}
                                </h4>
                                </div>
                                <div class="content card-padding">
                                    <fieldset class="rating-note" data-value="{{$note_floor}}">
                                        <input type="radio" id="star5" name="rating" value="5" disabled="" />
                                        <label class = "full" for="star5" title="5 stars"></label>

                                        <input type="radio" id="star4.5" name="rating" value="4.5" disabled="" />
                                        <label class="half" for="star4.5" title="4.5 stars"></label>

                                        <input type="radio" id="star4" name="rating" value="4" disabled="" />
                                        <label class = "full" for="star4" title="4 stars"></label>

                                        <input type="radio" id="star3.5" name="rating" value="3.5" disabled="" />
                                        <label class="half" for="star3.5" title="3.5 stars"></label>

                                        <input type="radio" id="star3" name="rating" value="3" disabled="" />
                                        <label class = "full" for="star3" title="3 stars"></label>

                                        <input type="radio" id="star2.5" name="rating" value="2.5" disabled="" />
                                        <label class="half" for="star2.5" title="2.5 stars"></label>

                                        <input type="radio" id="star2" name="rating" value="2" disabled="" />
                                        <label class = "full" for="star2" title="2 stars"></label>

                                        <input type="radio" id="star1.5" name="rating" value="1.5" disabled="" />
                                        <label class="half" for="star1.5" title="1.5 stars"></label>

                                        <input type="radio" id="star1" name="rating" value="1" disabled="" />
                                        <label class = "full" for="star1" title="1 star"></label>

                                        <input type="radio" id="star0.5" name="rating" value="0.5" disabled="" />
                                        <label class="half" for="star0.5" title="0.5 stars"></label>

                                    </fieldset>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title"><i class="fa fa-info-circle"></i> Taux de réponse: {{$taux}}%</h4>
                                </div>
                                <div class="content card-padding">
                                    <div id="circularGaugeContainer"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>
@endsection

@section('javascript')

<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/globalize/0.1.1/globalize.min.js"></script>
<script src='https://cdn3.devexpress.com/jslib/13.2.9/js/dx.chartjs.js'></script>
<script>
    $(function(){
        var densityCanvas = document.getElementById("densityChart");
        Chart.defaults.global.defaultFontFamily = "Arial";
        Chart.defaults.global.defaultFontSize = 13;
        var densityData = {
            label: 'Taux de réponses',
            data: [
                @foreach($reponses as $reponse)
                    {{$reponse->total}} , 
                @endforeach
            ],
            backgroundColor: [
                @foreach($reponses as $reponse)
                    'rgba(0, 99, 132, 0.6)',
                @endforeach
            ],
            borderColor: [
                @foreach($reponses as $reponse)
                    'rgba(0, 99, 132, 1)',
                @endforeach
            ],
            borderWidth: 2,
            hoverBorderWidth: 0
        };

        var chartOptions = {
            scales: {
                yAxes: [{
                    barPercentage: 0.3
                }],
                xAxes: [{
                    ticks:{
                        stepSize : 1,
                    },
                    stacked: true,
                }],
            },
            elements: {
                rectangle: {
                    borderSkipped: 'left',
                }
            }
        };

        var barChart = new Chart(densityCanvas, {
            type: 'horizontalBar',
            data: {
                labels: [
                    @foreach($reponses as $reponse)
                        "{!! $reponse->titre !!}" , 
                    @endforeach
                ],
                datasets: [densityData],
            },
            options: chartOptions
        });

        //taux de reponse **************************************************************

        $("#circularGaugeContainer").dxCircularGauge({
          rangeContainer: { 
            offset: 10,
            ranges: [
              { startValue: 0.75, endValue: 1, color: '#41A128' },
              { startValue: 0.5, endValue: 0.75, color: '#FF4500' },
              { startValue: 0, endValue: 0.5, color: '#FF0000' }
            ] // Dans ce tableau tu peux faire des couleurs par tranches
          },
          scale: {
            startValue: 0,  endValue: 1,
            majorTick: { tickInterval: 0.25 },
            label: {
              format: 'percent'
            }
          },
          size: {
            height: 200,
            width: 600
        },
          title: {
            subtitle: 'test',
            position: 'top-center'
          },
          tooltip: {
                enabled: true,
                format: 'percent',
                customizeText: function (arg) {
                    return 'Taux de réponse: ' + arg.valueText;
                }
            },
          value: {{$taux/100}} // Taux des réponses ici
        });

    });
</script>

@endsection





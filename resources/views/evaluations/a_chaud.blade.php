@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">les reponses par chaque questions</h4>
                                </div>

                                <div class="content card-padding">
                                    <div class="chart chart-js-container">
                                        <canvas id="densityChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">la note globale: {{$note}}</h4>
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
<script>
    $(function(){
        var densityCanvas = document.getElementById("densityChart");
        Chart.defaults.global.defaultFontFamily = "Arial";
        Chart.defaults.global.defaultFontSize = 13;
        var densityData = {
            label: 'Taux de reponses',
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
                        "{{$reponse->titre}}" , 
                    @endforeach
                ],
                datasets: [densityData],
            },
            options: chartOptions
        });
    });
        
</script>

@endsection





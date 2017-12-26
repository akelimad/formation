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
        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 14;
        var densityData = {
          label: 'test',
          data: [5427, 5243, 5514, 3933, 1326, 687, 1271, 1638],
          backgroundColor: [
            'rgba(0, 99, 132, 0.6)',
            'rgba(30, 99, 132, 0.6)',
            'rgba(60, 99, 132, 0.6)',
            'rgba(90, 99, 132, 0.6)',
            'rgba(120, 99, 132, 0.6)',
            'rgba(150, 99, 132, 0.6)',
            'rgba(180, 99, 132, 0.6)',
            'rgba(210, 99, 132, 0.6)',
            'rgba(240, 99, 132, 0.6)'
          ],
          borderColor: [
            'rgba(0, 99, 132, 1)',
            'rgba(30, 99, 132, 1)',
            'rgba(60, 99, 132, 1)',
            'rgba(90, 99, 132, 1)',
            'rgba(120, 99, 132, 1)',
            'rgba(150, 99, 132, 1)',
            'rgba(180, 99, 132, 1)',
            'rgba(210, 99, 132, 1)',
            'rgba(240, 99, 132, 1)'
          ],
          borderWidth: 2,
          hoverBorderWidth: 0
        };

        var chartOptions = {
          scales: {
            yAxes: [{
              barPercentage: 0.5
            }]
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
                    "{{$reponse->titre}}",
                @endforeach
            ],
            datasets: [densityData],
          },
          options: chartOptions
        });
    });
</script>

@endsection





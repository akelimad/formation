@extends('layouts.app')
@section('pageTitle', 'Salles')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <form action="" method="get">
                            <div class="content">
                                <div class="col-md-6">
                                    <h5 class="title">Selectionnez une salle pour voir ses occupations prochaines</h5>
                                </div>
                                <div class="col-md-4 mb-20">
                                    <select class="form-control" name="salle" required="">
                                        <option disabled selected value="">-- select --</option>
                                        @foreach ($salles as $s)
                                            <option value="{{ $s->id }}" @if(isset($selected) && $selected == $s->id) selected @endif > {{ $s->numero }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Consulter</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-calendar">
                                <div class="content" class="ps-child">
                                    <div id="fullCalendar"></div>
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
    @if(isset($occupations))
    <script src="{{ asset('assets/vendors/fr.js')}}"></script>
    <script>
        $(function(){
            var $calendar = $('#fullCalendar');
            var today = new Date();
            var y = today.getFullYear();
            var m = today.getMonth();
            var d = today.getDate();
            $calendar.fullCalendar({
                buttonText: {
                    today: "Aujourd'hui"
                },
                height: 500,
                locale: 'fr',
                viewRender: function(view, element) {
                    // We make sure that we activate the perfect scrollbar when the view isn't on Month
                    if (view.name != 'month'){
                        $(element).find('.fc-scroller').perfectScrollbar();
                    }
                },
                header: {
                    left: 'title',
                    center: '',
                    right: "prev,next,today"
                },
                defaultDate: today,
                selectLongPressDelay: 10,
                selectable: true,
                selectHelper: true,
                views: {
                    month: { // name of view
                        titleFormat: 'MMMM YYYY'
                        // other view-specific options here
                    },
                    week: {
                        titleFormat: " MMM D YYYY"
                    },
                    day: {
                        titleFormat: 'D MMM, YYYY'
                    }
                },

                // select: function(start, end) {

                //     // on select we show the Sweet Alert modal with an input
                //     swal({
                //         title: 'Create an Event',
                //         html: '<div class="form-group">' +
                //                 '<input class="form-control" placeholder="Event Title" id="input-field">' +
                //             '</div>',
                //                 showCancelButton: true,
                //         confirmButtonClass: 'btn btn-success',
                //         cancelButtonClass: 'btn btn-danger',
                //         buttonsStyling: false
                //     }).then(function(result) {

                //         var eventData;
                //         event_title = $('#input-field').val();

                //         if (event_title) {
                //                     eventData = {
                //                         title: event_title,
                //                         start: start,
                //                         end: end
                //                     };
                //                     $calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
                //                 }

                //                  $calendar.fullCalendar('unselect');

                //     },function(dismiss){

                //     });
                // },
                // editable: true,
                eventLimit: true, // allow "more" link when too many events


                // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
                events: [
                    @foreach($occupations as $session)
                    {
                        title: '{{ $session->nom }}',
                        start: '{{ $session->start }}',
                        end  : '{{ Carbon\Carbon::parse($session->end)->addDays(1) }}',
                        allDay: true,
                        className: 'event-default',
                    },
                    @endforeach
                ]
            });
        })
    </script>
    @endif
@endsection
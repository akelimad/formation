@extends('layouts.app')
@section('pageTitle', 'Participants')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content cours">
                    <h3> Recherche de formations </h3>
                    <div class="row">
                        <form action="{{ url('espace-collaborateurs/search') }}" >
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary pull-right"> <i class="fa fa-search"></i> </button> 
                            </div>
                            <div class="col-md-11">
                                <input type="search" class="form-control search-cours" name="cours" value="{{(isset($cours) ? $cours:'')}}" />
                            </div>
                        </form>
                    </div> 
                    <div class="row">
                        @forelse($sessions as $s)
                        <div class="col-md-3">
                            <div class="card cours-item">
                                <div class="cours-img-wrap">
                                    @if(isset($s->photo))
                                        <a href="{{url('espace-collaborateurs/formation/'.$s->session_id)}}"><img class="card-img-top" src="{{asset('coursPhotos/'.$s->photo)}}" alt="Card image cap"></a>
                                    @else
                                        <a href="{{url('espace-collaborateurs/formation/'.$s->session_id)}}"><img class="card-img-top" src="{{asset('/assets/img/image_placeholder.jpg')}}" alt="Card image cap"></a>
                                    @endif
                                </div>
                                <div class="content card-block">
                                    <h4 class="card-title"> <a href="{{url('espace-collaborateurs/formation/'.$s->session_id)}}">{{ $s->titre }}</a> </h4>
                                    <p class="card-text"> {{ $s->coursDesc }} </p>
                                    <a href="{{url('espace-collaborateurs/formation/'.$s->session_id)}}" class="btn btn-primary">En savoir plus</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-md-12">
                            @include('partials.alerts.info', ['messages' => 'Aucun cours trouvé ... !!'])
                        </div>
                        @endforelse
                    </div>

                    {{ $sessions->links() }}
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
@extends('layouts.app')
@section('pageTitle', 'Participants')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
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
                            <div class="card content">
                                <img class="card-img-top" src="{{asset('/assets/img/image_placeholder.jpg')}}" alt="Card image cap">
                                <div class="card-block">
                                    <h3 class="card-title"> {{ $s->titre }} </h3>
                                    <p class="card-text"> {{ $s->description }} </p>
                                    <a href="{{url('espace-collaborateurs/formation/'.$s->id)}}" class="btn btn-primary">En savoir plus</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-md-12">
                            <div class="alert alert-info alert-dismissable mt20" role="alert">
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                </button>
                                <span><i class="fa fa-info-circle"></i> Aucun cours trouvé ... !!!</span>
                            </div>
                        </div>
                        @endforelse
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
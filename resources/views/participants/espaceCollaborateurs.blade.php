@extends('layouts.app')
@section('pageTitle', 'Participants')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="">
                        <h3> Rechercher de formations </h3>
                        <div class="col-md-10">
                            <input type="text" class="form-control">                            
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> </button> 
                        </div>
                    </div>
                    <div class="row">
                        @foreach($sessions as $s)
                        <div class="col-md-4">
                            <div class="card content">
                                <img class="card-img-top" src="{{asset('/assets/img/image_placeholder.jpg')}}" alt="Card image cap">
                                <div class="card-block">
                                    <h3 class="card-title">Special title treatment</h3>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="{{url('espace-collaborateurs/formation/'.$s->id)}}" class="btn btn-primary">En savoir plus</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
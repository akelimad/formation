@extends('layouts.app')
@section('pageTitle', 'Détails de le session')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content details-session">
                    <div class="">
                        <h3> Détails de la formation: {{ $session->nom }} </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <img class="img-responsive" src="{{asset('coursPhotos/'.$session->cour->photo)}}" alt="cours photo">
                        </div>
                        <div class="col-md-5">
                            <p> <i class="fa fa-calendar"></i> 
                                Date début: {{ Carbon\Carbon::parse($session->start)->format('d/m/Y')}} </p>
                            <p> <i class="fa fa-calendar"></i> 
                                Date fin: {{ Carbon\Carbon::parse($session->end)->format('d/m/Y')}} </p>
                            <p> <i class="fa fa-map-marker"></i> Lieu: {{ $session->lieu }} </p>
                            @if(isset($session->cour->support))
                            <p> <i class="fa fa-download"></i> <a href="{{asset('coursSupport/'.$session->cour->support)}}" style="color: #5e9ef5" target="_blank" >Télécharger le support </a> </p>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <p> <i class="fa fa-user"></i> Formateur: {{ $session->formateur->nom }} </p>
                            <p> <i class="fa fa-bank"></i> Salle: {{ $session->salle->numero }} </p>
                            <p> <i class="fa fa-info-circle"></i> Statut: {{ $session->statut }} </p>
                            <p> <i class="fa fa-info-circle"></i> Methode: {{ $session->methode }} </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab1"> Tab 1 </a></li>
                            <li><a data-toggle="tab" href="#tab2"> Tab 2 </a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>HOME</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab2" class="tab-pane fade ">
                                <div class="row">
                                    <div class="content">
                                        <div class="col-md-6">
                                            <div class="panel panel-info">
                                                <div class="panel-heading"> header 1 </div>
                                                <div class="panel-body"> 
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            lorem 
                                                        </div>
                                                        <div class="col-md-8">
                                                            <ul class="list-unstyled">
                                                                <li> item1 </li>
                                                                <li> item1 </li>
                                                                <li> item1 </li>
                                                                <li> item1 </li>
                                                                <li> item1 </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="panel panel-info">
                                                <div class="panel-heading"> header 2 </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <i class="fa fa-user fa-5x"></i>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="comment">
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum quidem repellendus voluptas perspiciatis aut optio illo atque nobis. Unde maxime, nostrum dignissimos rem autem aliquid officia vel quaerat laudantium, alias.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="content">
                                        <div class="col-md-12">
                                            <div class="panel panel-info">
                                                <div class="panel-heading"> Evaluation </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <i class="fa fa-user fa-5x"></i>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="comment">
                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum quidem repellendus voluptas perspiciatis aut optio illo atque nobis. Unde maxime, nostrum dignissimos rem autem aliquid officia vel quaerat laudantium, alias.
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
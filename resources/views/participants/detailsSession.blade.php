@extends('layouts.app')
@section('pageTitle', 'Participants')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="">
                        <h3> Détails de formation </h3>
                    </div>
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
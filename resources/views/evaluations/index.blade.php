@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    @if(session()->has('no_participants'))
                        <div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><strong>Attention !</strong> {{ session()->get('no_participants') }} </span>
                        </div>
                    @endif
                    @if(session()->has('mails_sent'))
                        <div class="alert alert-success alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><strong>Succès !</strong> {{ session()->get('mails_sent') }} </span>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-info alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><strong><i class="fa fa-info-circle fa-2x"></i> </strong> {{$errors->first()}} </span>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="title">La liste des evaluations</h4>
                        </div>
                        
                        <div class="col-md-4">
                            <a href="{{ url('evaluations/create') }}" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Nouvelle</a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Sessions</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($evaluations as $evaluation)
                                <tr>
                                    <td> {{ $evaluation->nom }} </td>
                                    <td> {{ $evaluation->type }} </td>
                                    <td> {{ $evaluation->session }} </td>
                                    <td class="text-right">
                                        <a href="{{ url('evaluations/'.$evaluation->id.'/a-chaud') }}" class="btn btn-fill btn-default btn-icon stats" title="statistiques de reponses" data-toggle="tooltip"><i class="fa fa-bar-chart"></i></a>
                                        <a href="{{ url('evaluations/'.$evaluation->id.'/sendMail') }}" class="btn btn-fill btn-success btn-icon sendMail" title="Envoyer un email aux participants" data-toggle="tooltip"><i class="fa fa-envelope"></i></a>
                                        <a href="{{url('questionnaire/'.$evaluation->id)}}" class="btn btn-fill btn-default btn-icon add" title="voir le questionnaire" data-toggle="tooltip"> <i class="fa fa-eye"></i> </a>
                                        <a href="#" class="btn btn-fill btn-info btn-icon add" data-toggle="modal" data-target="#questionnaire_modal" data-id="{{$evaluation->id}}" title="Ajouter un questionnaire"> <i class="fa fa-question-circle-o"></i> </a>
                                        <a href="#" class="btn btn-fill btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon remove"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Sessions</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal fade" id="questionnaire_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter les questions</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form id="surveyForm" class="form-horizontal" action="{{ url('questions') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Evaluation</label>
                                                <div class="col-md-8">
                                                    <select class="selectpicker" name="evaluation" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" required="">
                                                        <option disabled selected>-- select --</option>
                                                        @foreach ($evaluations as $e)
                                                            <option value="{{ $e->id }}" > {{ $e->nom }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="questions-wrap">
                                                <div class="form-group" >
                                                    <label class="col-md-2 control-label">Question</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="questions[0]" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-default addLine"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- The option field template containing an option field and a Remove button -->
                                            <!-- <div class="form-group hide" id="optionTemplate">
                                                <label class="col-md-2 control-label">Question</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="text" name="questions[]" />
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                                                </div>
                                            </div> -->

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-rose btn-fill btn-wd">Sauvegarder</button>
                                                </div>
                                            </div>
                                        </form>
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



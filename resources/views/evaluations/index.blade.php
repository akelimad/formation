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
                            <span><i class="fa fa-exclamation-circle"></i> {{ session()->get('no_participants') }} </span>
                        </div>
                    @endif
                    @if(session()->has('mails_sent'))
                        <div class="alert alert-success alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><i class="fa fa-check-circle-o"></i> {{ session()->get('mails_sent') }} </span>
                        </div>
                    @endif
                    @if(session()->has('remembre_mails_sent'))
                        <div class="alert alert-success alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><i class="fa fa-check-circle-o"></i> {{ session()->get('remembre_mails_sent') }} </span>
                        </div>
                    @endif
                    @if(session()->has('survey_add'))
                        <div class="alert alert-success alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><i class="fa fa-check-circle-o"></i> {!! session()->get('survey_add') !!} </span>
                        </div>
                    @endif
                    @if(session()->has('no_response'))
                        <div class="alert alert-warning alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><i class="fa fa-exclamation-circle"></i> {{ session()->get('no_response') }} </span>
                        </div> 
                    @endif
                    @if(session()->has('under_3month'))
                        <div class="alert alert-warning alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><i class="fa fa-exclamation-circle"></i> {{ session()->get('under_3month') }} </span>
                        </div>
                    @endif
                    @if(session()->has('no_survey'))
                        <div class="alert alert-warning alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><i class="fa fa-exclamation-circle"></i> {{ session()->get('no_survey') }} </span>
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
                                    <th>Créé le</th>
                                    <th>Envoyé le</th>
                                    <th>Rappelé le</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($evaluations as $evaluation)
                                <tr>
                                    <td> {{ $evaluation->nom }} </td>
                                    <td> {{ $evaluation->type =='a-chaud' ? 'A chaud' : 'A froid' }} </td>
                                    <td> {{ $evaluation->session }} </td>
                                    <td> {{ $evaluation->created_at ? Carbon\Carbon::parse($evaluation->created_at)->format('d/m/Y') : '---' }} </td>
                                    <td> {{ $evaluation->envoye_le ? Carbon\Carbon::parse($evaluation->envoye_le)->format('d/m/Y') : '---' }} </td>
                                    <td> {{ $evaluation->rappele_le ? Carbon\Carbon::parse($evaluation->rappele_le)->format('d/m/Y') : '---' }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="{{ url('evaluations/'.$evaluation->id.'/'.$evaluation->type) }}" class="btn btn-fill btn-default btn-icon stats" title="statistiques de reponses" data-toggle="tooltip"><i class="fa fa-bar-chart"></i></a>
                                        <a href="{{ url('evaluations/'.$evaluation->id.'/sendMail') }}" class="btn btn-fill btn-success btn-icon sendMail" title="Envoyer un email aux participants" data-toggle="tooltip"><i class="fa fa-envelope"></i></a>
                                        <a href="{{ url('evaluations/'.$evaluation->id.'/remembreMail') }}" class="btn btn-fill btn-warning btn-icon sendMail" title="Rappeler les participants qui n'ont pas repondu" data-toggle="tooltip"><i class="fa fa-refresh"></i></a>
                                        <a href="{{url('questionnaire/'.$evaluation->id)}}" class="btn btn-fill btn-default btn-icon add" title="voir le questionnaire" data-toggle="tooltip"> <i class="fa fa-eye"></i> </a>
                                        <a href="#" class="btn btn-fill btn-info btn-icon add" data-toggle="modal" data-target="#questionnaire_modal" data-id="{{$evaluation->id}}" title="Ajouter un questionnaire"> <i class="fa fa-question-circle-o"></i> </a>
                                        <a href="{{url('questionnaire/'.$evaluation->id.'/edit')}}" class="btn btn-fill btn-info btn-icon add" data-toggle="tooltip" title="Editer le questionnaire"> <i class="ti-pencil-alt"></i> </a>
                                        <a href="{{url('evaluations/'.$evaluation->id.'/edit')}}" class="btn btn-fill btn-warning btn-icon edit" title="Editer l'evaluation" data-toggle="tooltip"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" data-id='{{$evaluation->id}}' class="btn btn-fill btn-danger btn-icon delete-evaluation" title="Supprimer l'evaluation" data-toggle="tooltip"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Sessions</th>
                                    <th>Créé le</th>
                                    <th>Envoyé le</th>
                                    <th>Rappelé le</th>
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
                                                    <select class="form-control" id="evaluationsList" name="evaluation"  required>
                                                        <option>-- select --</option>
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
                                                        <input type="text" class="form-control" name="questions[0]" required="required" />
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



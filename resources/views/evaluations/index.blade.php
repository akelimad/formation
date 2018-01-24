@extends('layouts.app')
@section('pageTitle', 'Evaluations')
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
                            <h4 class="title">La liste des évaluations <span class="badge">{{$evaluations->total()}}</span></h4>
                        </div>
                        
                        <div class="col-md-4">
                            <a href="javascript:void(0)" onclick="return chmEvaluation.create()" class="btn btn-primary pull-right addBtn" data-toggle="tooltip" title="Ajouter""> <i class="fa fa-plus"></i>  </a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    @if(count($evaluations)>0)
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Session</th>
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

                                        <a href="@if(!$evaluation->envoye_le) {{ url('evaluations/'.$evaluation->id.'/sendMail') }}@else javascript:void(0) @endif" class="btn btn-fill btn-success btn-icon sendMail" title="{{$evaluation->envoye_le ? 'Le mail est déjà envoyé':'Envoyer un email aux participants'}}" data-toggle="tooltip" {{$evaluation->envoye_le ? 'disabled':''}}><i class="fa fa-envelope"></i></a>

                                        <a href="@if($evaluation->envoye_le){{ url('evaluations/'.$evaluation->id.'/remembreMail') }}@else javascript:void(0) @endif" class="btn btn-fill btn-warning btn-icon sendMail" title="{{$evaluation->envoye_le ? 'Rappeler les participants qui n\'ont pas repondu':'Le questionnaire pas encore envoyé' }}" data-toggle="tooltip" {{$evaluation->envoye_le ? '':'disabled'}}><i class="fa fa-bell-o"></i></a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-default btn-icon" title="voir le questionnaire" onclick="return chmQuestion.show({id:{{ $evaluation->id }}})"> <i class="fa fa-eye"></i> </a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-info btn-icon" onclick="@if(count($evaluation->questions)>0) return chmQuestion.edit({id: {{ $evaluation->id }} }) @else return chmQuestion.create({eid: {{ $evaluation->id }} }) @endif"> <i class="fa fa-question-circle-o"></i> </a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-warning btn-icon" title="Editer l'evaluation" onclick="return chmEvaluation.edit({id:{{ $evaluation->id }}})"><i class="ti-pencil-alt"></i></a>

                                        <a href="javascript:void(0)" data-id='{{$evaluation->id}}' class="btn btn-fill btn-danger btn-icon delete-evaluation" title="Supprimer l'evaluation" data-toggle="tooltip"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Session</th>
                                    <th>Créé le</th>
                                    <th>Envoyé le</th>
                                    <th>Rappelé le</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                        <div class="alert alert-info mt20">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">x</button><span><i class="fa fa-info-circle"></i> Aucune donnée trouvée dans la table </span>
                        </div>
                    @endif

                    {{ $evaluations->links() }}

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection



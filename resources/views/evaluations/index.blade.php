@extends('layouts.app')
@section('pageTitle', 'Evaluations')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    @if(session()->has('no_participants'))
                        @include('partials.alerts.warning', ['messages' =>  session()->get('no_participants') ])
                    @endif
                    @if(session()->has('mails_sent'))
                        @include('partials.alerts.success', ['messages' =>  session()->get('mails_sent') ])
                    @endif
                    @if(session()->has('remembre_mails_sent'))
                        @include('partials.alerts.success', ['messages' =>  session()->get('remembre_mails_sent') ])
                    @endif
                    @if(session()->has('survey_add'))
                        @include('partials.alerts.success', ['messages' =>  session()->get('survey_add') ])
                    @endif
                    @if(session()->has('no_response'))
                        @include('partials.alerts.warning', ['messages' => session()->get('no_response') ])
                    @endif
                    @if(session()->has('under_3month'))
                        @include('partials.alerts.warning', ['messages' => session()->get('under_3month') ])
                    @endif
                    @if(session()->has('no_survey'))
                        @include('partials.alerts.warning', ['messages' => session()->get('no_survey') ])
                    @endif
                    @if(session()->has('all_answered'))
                        @include('partials.alerts.info', ['messages' => session()->get('all_answered') ])
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
                    <div class="material-datatables table-responsive">
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

                                        <a href="javascript:void(0)" class="btn btn-fill btn-default btn-icon" title="voir le questionnaire, si l'icon est desactivée c'est parce qu'il n'est pas encore ajouté" data-toggle="tooltip" onclick="@if($evaluation->questionsCount >0) return chmQuestion.show({id:{{ $evaluation->id }}}) @endif" {{$evaluation->questionsCount <=0 ? 'disabled':''}}> <i class="fa fa-eye"></i> </a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-info btn-icon" onclick="@if(!$evaluation->envoye_le) @if($evaluation->questionsCount >0) return chmQuestion.edit({id: {{ $evaluation->id }} }) @else return chmQuestion.create({eid: {{ $evaluation->id }} }) @endif @endif" title="{{$evaluation->envoye_le ? 'Le questionnaire déjà envoyé' : 'Ajouter ou modifier le questionnaire'}}" data-toggle="tooltip" {{$evaluation->envoye_le ? 'disabled':''}}> <i class="fa fa-question-circle-o"></i> </a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-warning btn-icon" title="Editer l'evaluation" data-toggle="tooltip" onclick="return chmEvaluation.edit({id:{{ $evaluation->id }}})"><i class="ti-pencil-alt"></i></a>
                                        @role('admin')
                                        <a href="javascript:void(0)" data-id='{{$evaluation->id}}' class="btn btn-fill btn-danger btn-icon delete-evaluation" title="Supprimer l'evaluation" data-toggle="tooltip"><i class="ti-close"></i></a>
                                        @endrole
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
                        @include('partials.alerts.info', ['messages' => "Aucune donnée trouvée dans la table ... !!" ])
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



@extends('layouts.app')
@section('pageTitle', 'Participants')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">La liste des participants <span class="badge">{{$participants->total()}}</span><a href="javascript:void(0)" onclick="return chmParticipant.create()" class="btn btn-primary pull-right addBtn" data-toggle="tooltip" title="Ajouter""> <i class="fa fa-plus"></i>  </a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    @if(count($participants)>0)
                    <div class="material-datatables">
                        <table  class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participants as $participant)
                                <tr>
                                    <td> {{ $participant->name }} </td>
                                    <td> {{ $participant->email }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="javascript:void(0)" data-toggle="tooltip" title="Modifier" onclick="return chmParticipant.edit({id:{{ $participant->id }}})" class="btn btn-fill btn-warning btn-icon"><i class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-fill btn-danger btn-icon delete-participant" data-id="{{$participant->id}}" data-toggle="tooltip" title="Supprimer"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
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

                    {{ $participants->links() }}

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
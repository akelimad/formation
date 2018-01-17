@extends('layouts.app')

@section('content') 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card filterCard">
                <div class="content">
                    <h5>Filters <button class="btn btn-primary pull-right btnFilter"> <i class="fa fa-plus"></i> </button></h5>
                    <div class="filterContent">
                        <form action="{{url('sessions/filter/search')}}" method="get" novalidate="novalidate">
                            <div class="filter">
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Date début</label>
                                        <input type="search" name="start" class="form-control datetimepicker" data-date-format="DD/MM/YYYY HH:mm" placeholder="Date début" value="{{isset($selected_start) ? $selected_start: ''}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Date début</label>
                                        <input type="search" name="end" class="form-control datetimepicker" data-date-format="DD/MM/YYYY HH:mm" placeholder="Date fin" value="{{isset($selected_end) ? $selected_end: ''}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group label-floating">
                                        <label class="control-label"> Statut </label>
                                        <select class="form-control" name="statut">
                                            <option disabled selected>-- select --</option>
                                            <option value="Aprobation en attente" @if(isset($selected) && $selected == "Aprobation en attente") selected @endif >Aprobation en attente</option>

                                            <option value="Programmé" @if(isset($selected) && $selected == "Programmé") selected @endif >Programmé</option>

                                            <option value="Terminé" @if(isset($selected) && $selected == "Terminé") selected @endif >Terminé</option>

                                            <option value="Annulé" @if(isset($selected) && $selected == "Annulé") selected @endif >Annulé</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="filterActions">
                                        <a href="{{url('sessions')}}" class="btn btn-success pull-right"><i class="fa fa-refresh"></i> Actualiser</a>
                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Consulter</button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="title">La liste des sessions </h4>
                        </div>
                        <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#addSession_modal" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Session </a>
                            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#participant_modal"> <i class="fa fa-plus"></i> Participant </a>
                            <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#formateur_modal"> <i class="fa fa-plus"></i> Formateur </a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        
                    </div>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th style="width: 13%">Nom session</th>
                                    <th style="width: 13%">Cours</th>
                                    <th style="width: 9%">Formateur</th>
                                    <th style="width: 9%">Salle</th>
                                    <th style="width: 9%">Lieu</th>
                                    <th style="width: 9%">Date début</th>
                                    <th style="width: 9%">Date fin</th>
                                    <th style="width: 9%">Statut</th>
                                    <th style="width: 20%" class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $session)
                                <tr>
                                    <td> {{ $session->nom }} </td>
                                    <td> {{ $session->cour->titre }} </td>
                                    <td> {{ $session->formateur->nom }} </td>
                                    <td> {{ $session->salle->numero }} </td>
                                    <td> {{ $session->lieu }} </td>
                                    <td> {{ Carbon\Carbon::parse($session->start)->format('d/m/Y')}} </td>
                                    <td> {{ Carbon\Carbon::parse($session->end)->format('d/m/Y')}} </td>
                                    <td> {{ $session->statut }} </td>
                                    <td class="text-right">
                                        <a href="#" data-toggle="modal" data-target="#showSession_modal" class="btn btn-fill btn-default btn-icon showSession" title="Afficher les détails" data-id="{{$session->id}}"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-fill btn-info btn-icon addBudget" data-toggle="modal" data-target="#addBudget_modal" data-id="{{$session->id}}" title="Ajouter un budget"><i class="fa fa-usd"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#editSession_modal" class="btn btn-fill btn-warning btn-icon editSession" title="Modifier" data-id="{{$session->id}}"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-session" data-id="{{$session->id}}" title="Supprimer"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width: 13%">Nom session</th>
                                    <th style="width: 13%">Cours</th>
                                    <th style="width: 9%">Formateur</th>
                                    <th style="width: 9%">Salle</th>
                                    <th style="width: 9%">Lieu</th>
                                    <th style="width: 9%">Date début</th>
                                    <th style="width: 9%">Date fin</th>
                                    <th style="width: 9%">Statut</th>
                                    <th style="width: 20%" class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{ $sessions->links() }}

                    <!-- formateurs modal -->
                    <div class="modal fade" id="formateur_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter un formateur</h3>
                                </div>
                                <div class="modal-body">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- participant modal -->
                    <div class="modal fade" id="participant_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter un participant</h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- budgets modal -->
                    <div class="modal fade" id="addBudget_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter les budgets de la session</h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- add session form modal -->
                    <div class="modal fade" id="addSession_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter une session</h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editSession_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Editer une session</h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="showSession_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Détails de la session</h3>
                                </div>
                                <div class="modal-body">
                                    
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
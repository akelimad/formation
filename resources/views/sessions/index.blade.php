@extends('layouts.app')

@section('content') 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <form action="{{url('sessions/filter/search')}}" method="get" novalidate="novalidate">
                        <div class="filter">
                            <div class="col-md-1">
                                <p>Filtres: </p>
                            </div>
                            <div class="col-md-2">
                                <input type="search" name="start" class="form-control datetimepicker" data-date-format="DD/MM/YYYY HH:mm" placeholder="Date début" value="{{isset($selected_start) ? $selected_start: ''}}">
                            </div>
                            <div class="col-md-2">
                                <input type="search" name="end" class="form-control datetimepicker" data-date-format="DD/MM/YYYY HH:mm" placeholder="Date fin" value="{{isset($selected_end) ? $selected_end: ''}}">
                            </div>
                            <div class="col-md-1">
                                <p class="pull-right">Statut: </p>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="statut">
                                    <option disabled selected>-- select --</option>
                                    <option value="Aprobation en attente" @if(isset($selected) && $selected == "Aprobation en attente") selected @endif >Aprobation en attente</option>

                                    <option value="Programmé" @if(isset($selected) && $selected == "Programmé") selected @endif >Programmé</option>

                                    <option value="Terminé" @if(isset($selected) && $selected == "Terminé") selected @endif >Terminé</option>

                                    <option value="Annulé" @if(isset($selected) && $selected == "Annulé") selected @endif >Annulé</option>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <a href="{{url('sessions')}}" class="btn btn-success pull-right"><i class="fa fa-refresh"></i> Actualiser</a>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Consulter</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="title">La liste des sessions </h4>
                        </div>
                        <div class="col-md-6">
                            <a href="{{url('sessions/create')}}" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Session </a>
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
                                    <th>Nom de la session</th>
                                    <th>Cours</th>
                                    <th>Formateur</th>
                                    <th>Salle</th>
                                    <th>Lieu</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Statut</th>
                                    <th class="disabled-sorting text-right">Actions</th>
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
                                        <a href="{{url('sessions/'.$session->id)}}" class="btn btn-fill btn-default btn-icon " title="Afficher les détails"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-fill btn-info btn-icon addBudget" data-toggle="modal" data-target="#budget_modal" data-id="{{$session->id}}" title="Ajouter un budget"><i class="fa fa-usd"></i></a>
                                        <a href="{{url('sessions/'.$session->id.'/edit')}}" class="btn btn-fill btn-warning btn-icon edit" title="Modifier"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-session" data-id="{{$session->id}}" title="Supprimer"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom de la session</th>
                                    <th>Cour</th>
                                    <th>Formateur</th>
                                    <th>Salle</th>
                                    <th>Lieu</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Statut</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- formateurs modal -->
                    @include('partials/formateurs.create')

                    <!-- participant modal -->
                    @include('partials/participants.create')

                    <!-- budgets modal -->
                    @include('partials/budgets.create')

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
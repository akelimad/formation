@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content"> 
                    <h4 class="title">La liste des formateurs <span class="badge">{{$formateurs->total()}}</span> <a href="#" data-toggle="modal" data-target="#addFormateur_modal" class="btn btn-primary pull-right addBtn"> <i class="fa fa-plus"></i>  </a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rating</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formateurs as $formateur)
                                <tr>
                                    <td> {{ $formateur->nom }} </td>
                                    <td> {{ $formateur->type }} </td>
                                    <td> {{ $formateur->email }} </td>
                                    <td> {{ $formateur->tel }} </td>
                                    <td> {{ $formateur->rating ? $formateur->rating .'%' : '0%' }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="#" data-id="{{$formateur->id}}" data-toggle="modal" data-target="#showFormateur_modal" class="btn btn-fill btn-default btn-icon showFormateur"><i class="fa fa-eye"></i></a>
                                        <a href="#" data-id="{{$formateur->id}}"  data-toggle="modal" data-target="#editFormateur_modal" class="btn btn-fill btn-warning btn-icon editFormateur"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-formateur" data-id="{{$formateur->id}}"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rating</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{ $formateurs->links() }}

                    <div class="modal fade" id="showFormateur_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Détails du formateur </h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editFormateur_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Editer le formateur </h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="addFormateur_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Ajouter un formateur </h3>
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
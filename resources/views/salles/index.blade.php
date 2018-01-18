@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="title">La liste des salles <span class="badge">{{$salles->total()}}</span></h4>
                        </div>
                        
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary pull-right addBtn" data-toggle="modal" data-target="#addSalle_modal"> <i class="fa fa-plus"></i>  </a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Capacité</th>
                                    <th>Equipements</th>
                                    <th>Photo</th>
                                    <th>Disposition</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salles as $salle)
                                <tr>
                                    <td> {{ $salle->numero }} </td>
                                    <td> {{ $salle->capacite }} </td>
                                    <td> {{ $salle->equipements }} </td>
                                    <td> 
                                        @if($salle->photo)
                                            <img src="{{url('sallePhotos/'.$salle->photo)}}" width="60" alt="" height="20"> 
                                        @else
                                            <img src="{{url('assets/img/missing-photo.png')}}" width="30" height="20" alt=""> 
                                        @endif
                                    </td>
                                    <td> {{ $salle->disposition }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="#" data-toggle="modal" data-target="#showSalle_modal" class="btn btn-fill btn-default btn-icon showSalle" data-id="{{$salle->id}}"><i class="fa fa-eye"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#editSalle_modal" class="btn btn-fill btn-warning btn-icon editSalle" data-id="{{$salle->id}}"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-salle" data-id="{{$salle->id}}"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Capacité</th>
                                    <th>Equipements</th>
                                    <th>Photo</th>
                                    <th>Disposition</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{ $salles->links() }}

                    <div class="modal fade" id="showSalle_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Détails de la salle </h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editSalle_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Editer la salle </h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="addSalle_modal" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Ajouter une salle </h3>
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
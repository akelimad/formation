@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="prestataire alert alert-success alert-dismissable" role="alert" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <span><strong><i class="fa fa-check "></i></strong> Le prestataire a été modifié avec suucès</span>
                    </div>
                    <h4 class="title">La liste des prestataires <a href="#" data-toggle="modal" data-target="#addPrestataire_modal" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Ajouter</a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Tel</th>
                                    <th>Fax</th>
                                    <th>Email</th>
                                    <th>Personne 1er contact</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prestataires as $f)
                                <tr>
                                    <td> {{ $f->nom }} </td>
                                    <td> {{ $f->type }} </td>
                                    <td> {{ $f->tel }} </td>
                                    <td> {{ $f->fax }} </td>
                                    <td> {{ $f->email }} </td>
                                    <td> {{ $f->personne_contacter }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <!-- <a href="{{url('prestataires/'.$f->id)}}" class="btn btn-fill btn-default btn-icon "><i class="fa fa-eye"></i></a> -->
                                        <a href="#" data-toggle="modal" data-target="#showPrestataire_modal" class="btn btn-fill btn-default btn-icon showPrestataire" data-id="{{$f->id}}"><i class="fa fa-eye"></i></a>
                                        <!-- <a href="{{url('prestataires/'.$f->id.'/edit')}}" class="btn btn-fill btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a> -->
                                        <a href="#" data-toggle="modal" data-target="#editPrestataire_modal" class="btn btn-fill btn-warning btn-icon editPrestataire" data-id="{{$f->id}}"><i class="ti-pencil-alt"></i></a>

                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-prestataire" data-id="{{$f->id}}"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Tel</th>
                                    <th>Fax</th>
                                    <th>Email</th>
                                    <th>Personne 1er contact</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{$prestataires->links()}}

                    <div class="modal fade" id="showPrestataire_modal" tabindex="-1" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Détails du prestataire </h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editPrestataire_modal" tabindex="-1" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Editer les infos du prestataire </h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="addPrestataire_modal" tabindex="-1" aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center"> Ajouter un prestataire </h3>
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
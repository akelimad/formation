@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">La liste des participants <a href="#" data-toggle="modal" data-target="#participant_modal" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Nouveau</a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
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
                                    <td> {{ $participant->nom }} </td>
                                    <td> {{ $participant->email }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="#" class="btn btn-fill btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-participant" data-id="{{$participant->id}}"><i class="ti-close"></i></a>
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

                    {{ $participants->links() }}

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

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
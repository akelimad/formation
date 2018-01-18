@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="title">La liste des budgets et leurs session</h4>
                        </div>
                        
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary pull-right addBtn" data-toggle="modal" data-target="#addBudget_modal"> <i class="fa fa-plus"></i>  </a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table class="table table-no-bordered table-hover budgetsTable" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Session</th>
                                    <th>Budget</th>
                                    <th>Prevu</th>
                                    <th>Realisé</th>
                                    <th>Ajustement</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sessions as $session)
                                    @if(count($session->budgets)>0)
                                    <tr>
                                        <td> {{ $session->nom }} </td>
                                        <td>  </td>
                                        <td>  </td>
                                        <td>  </td>
                                        <td>  </td>
                                        <td class="text-right">
                                            {{ csrf_field() }}
                                            <a href="#" class="btn btn-fill btn-default btn-icon showBudget" data-toggle="modal" data-target="#showBudget_modal" data-id="{{$session->id}}"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-fill btn-warning btn-icon editBudget" title="Editer les budgets" data-toggle="modal" data-target="#editBudget_modal" data-id="{{$session->id}}" title="Ajouter un budget"><i class="ti-pencil-alt"></i></a>
                                            <a href="#" class="btn btn-fill btn-danger btn-icon delete-budget" data-id="{{$session->id}}"><i class="ti-close"></i></a>
                                        </td>
                                        @foreach($session->budgets as $budget)
                                        <tr class="no-border-bottom">
                                            <td ></td>
                                            <td>{{ $budget->budget }}</td>
                                            <td>{{ $budget->prevu }}</td>
                                            <td>{{ $budget->realise }}</td>
                                            <td>{{ $budget->ajustement }}</td>
                                            <td> </td>
                                        </tr>
                                        @endforeach
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Budget</th>
                                    <th>Prevu</th>
                                    <th>Realisé</th>
                                    <th>Ajustement</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {!! $sessions->links() !!}

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
                    <div class="modal fade" id="editBudget_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Editer les budgets de la session</h3>
                                </div>
                                <div class="modal-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="showBudget_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Détails des budgets de la session</h3>
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
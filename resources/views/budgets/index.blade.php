@section('pageTitle', 'Budgets')
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
                                            <a href="javascript:void(0)" class="btn btn-fill btn-default btn-icon" onclick="return chmBudget.show({id:{{ $session->id }}})" data-toggle="tooltip" title="Voir"><i class="fa fa-eye"></i></a>

                                            <a href="javascript:void(0)" class="btn btn-fill btn-warning btn-icon" title="Modifier"  onclick="return chmBudget.edit({id:{{ $session->id }}})" data-toggle="tooltip"><i class="ti-pencil-alt"></i></a>

                                            <a href="javascript:void(0)" class="btn btn-fill btn-danger btn-icon delete-budget" data-toggle="tooltip" title="Supprimer" data-id="{{$session->id}}"><i class="ti-close"></i></a>
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
                                    <th>Session</th>
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

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
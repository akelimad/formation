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
                            <a href="{{ url('budgets/create') }}" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Nouveau</a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-no-bordered table-hover budgetsTable" style="width:100%;cellspacing:0">
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
                                            <a href="{{ url('budgetsSession/'.$session->id.'/edit') }}" class="btn btn-fill btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                            <!-- <a href="#" class="btn btn-fill btn-info btn-icon addBudget" title="Editer les budgets" data-toggle="modal" data-target="#budget_modal" data-id="{{$session->id}}" title="Ajouter un budget"><i class="fa fa-usd"></i></a> -->
                                            <a href="#" class="btn btn-fill btn-danger btn-icon delete-budget" data-id="{{$session->id}}"><i class="ti-close"></i></a>
                                        </td>
                                        @foreach($session->budgets as $budget)
                                        <tr>
                                            <td></td>
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

                    <div class="modal fade" id="budget_modal"  aria-labelledby="gridSystemModalLabel" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-close"></span></a>
                                    <h3 class="modal-title text-center">Ajouter les budgets de la session</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form id="" action="{{ url('budgets') }}" method="post" class="col-md-10 col-md-offset-1">
                                            {{ csrf_field() }}
                                            <div class="">
                                                <div class="row">
                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Nom
                                                                <star>*</star>
                                                            </label>
                                                            <input class="form-control" name="nom" type="text" placeholder="Titre" />
                                                        </div>
                                                    </div>  -->
                                                    <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Session<star>*</star> </label>
                                                            <select class="form-control" id="sessionsList" name="session"  required>
                                                                <option>-- select --</option>
                                                                @foreach ($sessions as $s)
                                                                    <option value="{{ $s->id }}" > {{ $s->nom }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label">Montant(Dhs)
                                                                <star>*</star>
                                                            </label>
                                                            <input class="form-control" name="montant" type="text" placeholder="Montant" />
                                                        </div>
                                                    </div> -->

                                                </div>

                                                <div id="budgets-wrap">
                                                    <div class="form-group">

                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label class="control-label">Libellé du budget </label>
                                                                <input type="text" class="form-control" name="budgets[0][budget]" placeholder="libellé de budget" required="" value="test" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label">Montant prévu </label>
                                                                <input type="number" class="form-control prevu" name="budgets[0][prevu]" placeholder="Prévu" min="0" required="" />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label">Montant réalisé </label>
                                                                <input type="number" class="form-control realise" name="budgets[0][realise]" placeholder="Réalisé" min="0" required="" />
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="control-label">Ajustement </label>
                                                                <input type="number" class="form-control ajustement"  name="budgets[0][ajustement]" placeholder="Ajustement" />
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label class="control-label"> </label>
                                                                <button type="button" class="btn btn-default addLine pull-right"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="category form-category">
                                                    <star>*</star> Champ obligatoire</div>
                                                <div class="text-center">
                                                    <input type="submit" class="btn btn-rose btn-fill btn-wd" value="Sauvegarder">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
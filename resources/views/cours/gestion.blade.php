@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <form action="" method="get">
                            <div class="content">
                                <div class="col-md-6">
                                    <h4 class="title">Selectionnez un utilisateur pour voir ses cours</h4>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="user" required="">
                                        <option disabled selected value="">-- select --</option>
                                        @foreach ($users as $u)
                                            <option value="{{ $u->id }}" @if(isset($selected) && $selected == $u->id) selected @endif > {{ $u->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Consulter</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    @if(isset($user_cours) && count($user_cours)>0)
                        <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Coordinateur</th>
                                    <th>Durée(j)</th>
                                    <th>Budget(DH)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_cours as $cour)
                                <tr>
                                    <td> {{ $cour->titre }} </td>
                                    <td> {{ $cour->user->name }} </td>
                                    <td> {{ $cour->duree }} </td>
                                    <td> {{ $cour->prix }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Coordinateur</th>
                                    <th>Durée(j)</th>
                                    <th>Budget(DH)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                        <div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><i class="fa fa-exclamation-circle"></i> Aucun cours à afficher </span>
                        </div>
                    @endif
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
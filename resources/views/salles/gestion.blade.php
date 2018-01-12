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
                                    <h4 class="title">Selectionnez une salle pour voir ses sessions</h4>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" name="salle" required="">
                                        <option disabled selected value="">-- select --</option>
                                        @foreach ($salles as $s)
                                            <option value="{{ $s->id }}" @if(isset($selected) && $selected == $s->id) selected @endif > {{ $s->numero }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> consulter</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    @if(isset($sessions_salle))
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sessions_salle as $session)
                                    <tr>
                                        <td> {{ $session->nom }} </td>
                                        <td> {{ $session->cour->titre }} </td>
                                        <td> {{ $session->formateur->nom }} </td>
                                        <td> {{ $session->salle->numero }} </td>
                                        <td> {{ $session->lieu }} </td>
                                        <td> {{ Carbon\Carbon::parse($session->start)->format('d/m/Y')}} </td>
                                        <td> {{ Carbon\Carbon::parse($session->end)->format('d/m/Y')}} </td>
                                        <td> {{ $session->statut }} </td>
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
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <span><i class="fa fa-exclamation-circle"></i> Aucune session à afficher </span>
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
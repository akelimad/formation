@section('pageTitle', 'Cours')
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="title">La liste des cours <span class="badge">{{$cours->total()}}</span></h4>
                        </div>
                        
                        <div class="col-md-4">
                            <a href="javascript:void(0)" class="btn btn-primary pull-right addBtn" data-toggle="tooltip" title="Ajouter"" onclick="return chmCours.create()"> <i class="fa fa-plus"></i>  </a>
                            <a href="{{url('cours/c/export')}}" class="pull-right excelIcon"  data-toggle="tooltip" title="Exporter vers Excel"><i class="fa fa-file-excel-o fa-2x"></i></a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    @if(count($cours)>0)
                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Coordinateur</th>
                                    <th>Durée(j)</th>
                                    <th>Budget(DH)</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cours as $cour)
                                <tr>
                                    <td> {{ $cour->titre }} </td>
                                    <td> {{ $cour->user->name }} </td>
                                    <td> {{ $cour->duree }} </td>
                                    <td> {{ $cour->prix }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="javascript:void(0)" class="btn btn-fill btn-default btn-icon" onclick="return chmCours.show({id:{{ $cour->id }}})"><i class="fa fa-eye"></i></a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-warning btn-icon" onclick="return chmCours.edit({id:{{ $cour->id }}})"><i class="ti-pencil-alt"></i></a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-danger btn-icon delete-cours" data-id="{{$cour->id}}"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Coordinateur</th>
                                    <th>Durée(j)</th>
                                    <th>Budget(DH)</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                        <div class="alert alert-info mt20">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">x</button><span><i class="fa fa-info-circle"></i> Aucune donnée trouvée dans la table </span>
                        </div>
                    @endif

                    {{ $cours->links() }}

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
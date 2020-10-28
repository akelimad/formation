@extends('layouts.app')
@section('pageTitle', 'Formateurs')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content"> 
                    <h4 class="title">La liste des formateurs <span class="badge">{{$results->total()}}</span> <a href="javascript:void(0)" onclick="return chmFormateur.create()" class="btn btn-primary pull-right addBtn" data-toggle="tooltip" title="Ajouter""> <i class="fa fa-plus"></i>  </a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    @if(count($results)>0)
                    <div class="material-datatables table-responsive">
                        <table class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Prestataire</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rating</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $formateur)
                                <tr>
                                    <td> {{ $formateur->nom }} </td>
                                    <td> {{ $formateur->type }} </td>
                                    <td> @if($formateur->prestataire_id != 0) {{$formateur->prestataire->nom}} @else --- @endif </td>
                                    <td> {{ $formateur->email }} </td>
                                    <td> {{ $formateur->tel }} </td>
                                    <td> {{ $formateur->rating ? $formateur->rating .'%' : '0%' }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="javascript:void(0)" onclick="return chmFormateur.show({id:{{ $formateur->id }}})" class="btn btn-fill btn-default btn-icon" data-toggle="tooltip" title="Voir"><i class="fa fa-eye"></i></a>

                                        <a href="javascript:void(0)" onclick="return chmFormateur.edit({id:{{ $formateur->id }}})" class="btn btn-fill btn-warning btn-icon" data-toggle="tooltip" title="Modifier"><i class="ti-pencil-alt"></i></a>
                                        @role('admin')
                                        <a href="javascript:void(0)" class="btn btn-fill btn-danger btn-icon delete-formateur" data-id="{{$formateur->id}}" data-toggle="tooltip" title="Supprimer"><i class="ti-close"></i></a>
                                        @endrole
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Prestataire</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rating</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                        @include('partials.alerts.info', ['messages' => "Aucune donnée trouvée dans la table ... !!" ])
                    @endif

                    @include('partials.pagination')

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
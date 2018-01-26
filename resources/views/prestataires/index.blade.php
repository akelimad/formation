@extends('layouts.app')
@section('pageTitle', 'Prestataires')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">La liste des prestataires <span class="badge">{{$prestataires->total()}}</span>
                        <a href="javascript:void(0)" onclick="return chmPrestataire.create()" class="btn btn-primary pull-right addBtn" data-toggle="tooltip" title="Ajouter"">  <i class="fa fa-plus"></i> </a>
                    </h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    @if(count($prestataires)>0)
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
                                        <a href="javascript:void(0)" onclick="return chmPrestataire.show({id:{{ $f->id }}})" class="btn btn-fill btn-default btn-icon"  data-toggle="tooltip" title="Voir"><i class="fa fa-eye"></i></a>

                                        <a href="javascript:void(0)" onclick="return chmPrestataire.edit({id:{{ $f->id }}})" class="btn btn-fill btn-warning btn-icon" data-toggle="tooltip" title="Modifier"><i class="ti-pencil-alt"></i></a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-danger btn-icon delete-prestataire" data-id="{{$f->id}}" data-toggle="tooltip" title="Supprimer"><i class="ti-close"></i></a>
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
                    @else
                        <div class="alert alert-info mt20">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">x</button><span><i class="fa fa-info-circle"></i> Aucune donnée trouvée dans la table </span>
                        </div>
                    @endif

                    {{$prestataires->links()}}

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
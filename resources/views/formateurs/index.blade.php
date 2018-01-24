@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content"> 
                    <h4 class="title">La liste des formateurs <span class="badge">{{$formateurs->total()}}</span> <a href="javascript:void(0)" onclick="return chmFormateur.create()" class="btn btn-primary pull-right addBtn" data-toggle="tooltip" title="Ajouter""> <i class="fa fa-plus"></i>  </a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    if(count($formateurs)>0)
                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rating</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formateurs as $formateur)
                                <tr>
                                    <td> {{ $formateur->nom }} </td>
                                    <td> {{ $formateur->type }} </td>
                                    <td> {{ $formateur->email }} </td>
                                    <td> {{ $formateur->tel }} </td>
                                    <td> {{ $formateur->rating ? $formateur->rating .'%' : '0%' }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="javascript:void(0)" onclick="return chmFormateur.show({id:{{ $formateur->id }}})" class="btn btn-fill btn-default btn-icon"><i class="fa fa-eye"></i></a>

                                        <a href="javascript:void(0)" onclick="return chmFormateur.edit({id:{{ $formateur->id }}})" class="btn btn-fill btn-warning btn-icon"><i class="ti-pencil-alt"></i></a>

                                        <a href="javascript:void(0)" class="btn btn-fill btn-danger btn-icon delete-formateur" data-id="{{$formateur->id}}"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Rating</th>
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

                    {{ $formateurs->links() }}

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
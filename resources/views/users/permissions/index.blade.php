@extends('layouts.app')
@section('pageTitle', 'Permissions')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">La liste des permissions <span class="badge">{{$permissions->total()}}</span><a href="javascript:void(0)" onclick="return chmPermission.create()" class="btn btn-primary pull-right addBtn" data-toggle="tooltip" title="Ajouter""> <i class="fa fa-plus"></i>  </a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    @if(count($permissions)>0)
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Le nom affiché</th>
                                    <th>Description</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td> {{ $permission->name }} </td>
                                    <td> {{ $permission->display_name ? $permission->display_name : '----' }} </td>
                                    <td> {{ $permission->description ? $permission->description  : '----'}} </td>
                                    <td class="text-right">
                                        <a href="javascript:void(0)" onclick="return chmPermission.edit({id:{{ $permission->id }}})" class="btn btn-fill btn-warning btn-icon"><i class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-fill btn-danger btn-icon remove disabled" disabled><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Le nom affiché</th>
                                    <th>Description</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                        @include('partials.alerts.info', ['messages' => "Aucune donnée trouvée dans la table ... !!" ])
                    @endif
                    
                    {{ $permissions->links() }}

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
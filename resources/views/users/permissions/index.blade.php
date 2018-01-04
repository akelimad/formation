@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">La liste des permissions <a href="{{ url('utilisateurs/permissions/create') }}" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Nouvelle</a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
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
                                        <a href="#" class="btn btn-fill btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon remove"><i class="ti-close"></i></a>
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
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
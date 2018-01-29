@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">La liste des rôles <span class="badge">{{$roles->total()}}</span><a href="javascript:void(0)" onclick="return chmRole.create()" class="btn btn-primary pull-right addBtn" data-toggle="tooltip" title="Ajouter""> <i class="fa fa-plus"></i>  </a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Le nom affiché</th>
                                    <th>Description</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td> {{ $role->name }} </td>
                                    <td> {{ $role->display_name ? $role->display_name : '---' }} </td>
                                    <td> {{ $role->description ? $role->description : '---' }} </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="javascript:void(0)" onclick="return chmRole.edit({id:{{ $role->id }}})" class="btn btn-fill btn-warning btn-icon"><i class="ti-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-fill btn-danger btn-icon delete-role" data-id="{{$role->id}}"><i class="ti-close"></i></a>
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
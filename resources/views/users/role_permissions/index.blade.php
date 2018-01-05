@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">La gestion des droits d'accès </h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table id="datatables" class="table" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>routes</th>
                                    @foreach($roles as $role)
                                        <th> {{$role->name}} </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($routes as $route)
                                <tr>
                                    <td> {{ $route['path'] }} </td>
                                    <td> 
                                        <input type="checkbox">
                                    </td>
                                    <td> 
                                        <input type="checkbox">
                                    </td>
                                    <td> 
                                        <input type="checkbox">
                                    </td>
                                </tr>
                                @endforeach
                                 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>routes</th>
                                    @foreach($roles as $role)
                                        <th> {{$role->name}} </th>
                                    @endforeach
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
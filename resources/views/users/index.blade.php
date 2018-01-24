@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <h4 class="title">La liste des utilisateurs <span class="badge">{{$users->total()}}</span> <a href="#" onclick="return chmUser.create()" class="btn btn-primary pull-right addBtn"> <i class="fa fa-plus"></i>  </a></h4>
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date d'ajout</th>
                                    <th>Rôle</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i')}} </td>
                                    <td>
                                        @if(count($user->roles)>0) 
                                            @foreach($user->roles as $role)
                                                {{$role->name}}
                                            @endforeach
                                        @else
                                            ---
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        {{ csrf_field() }}
                                        <a href="#" onclick="return chmUser.edit({id:{{ $user->id }}})" class="btn btn-fill btn-warning btn-icon"><i class="ti-pencil-alt"></i></a>

                                        <a href="#" class="btn btn-fill btn-danger btn-icon delete-user" data-id="{{$user->id}}"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date d'ajout</th>
                                    <th>Rôle</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{ $users->links() }}

                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
</div>

@endsection
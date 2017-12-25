@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="title">La liste des salles</h4>
                        </div>
                        
                        <div class="col-md-4">
                            <a href="{{ url('salles/create') }}" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> Nouvelle</a>
                        </div>
                    </div>
                    
                    <div class="toolbar">
                        <!-- Here you can write extra buttons/actions for the toolbar   -->
                    </div>
                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width:100%;cellspacing:0">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Capacité</th>
                                    <th>Equipements</th>
                                    <th>Photo</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salles as $salle)
                                <tr>
                                    <td> {{ $salle->numero }} </td>
                                    <td> {{ $salle->capacite }} </td>
                                    <td> {{ $salle->equipements }} </td>
                                    <td> 
                                        @if($salle->photo)
                                            <img src="{{url('sallePhotos/'.$salle->photo)}}" width="60" alt="" height="20"> 
                                        @else
                                            <img src="{{url('assets/img/missing-photo.png')}}" width="30" height="20" alt=""> 
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ url('salles/'.$salle->id.'/edit') }}" class="btn btn-fill btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-fill btn-danger btn-icon remove"><i class="ti-close"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Numero</th>
                                    <th>Capacité</th>
                                    <th>Equipements</th>
                                    <th>Photo</th>
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
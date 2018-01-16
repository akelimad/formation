@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="allInputsFormValidation1" action="{{ url('salles') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="content">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <span><strong>Attention !</strong> {{ $error }}</span>
                                </div>
                            @endforeach
                        @endif
                        <h4 class="title">Ajouter une salle</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Numéro <star>*</star></label>
                                    <input class="form-control" name="numero" type="number" required="required" placeholder="Numero" value="{{old('numero')}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Capacité <star>*</star></label>
                                    <input class="form-control" name="capacite" type="number" required="required" placeholder="Capacité" value="{{old('capacite')}}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Equipements <star>*</star></label>
                                    <input class="form-control" name="equipements" type="text" placeholder="Equipements" value="{{old('equipements')}}" required="required" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Photo</label>
                                    <input type="file" name="photo" class="form-control" accept="image/*" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Disposition</label>
                                    <input class="form-control" name="disposition" type="text" placeholder="Disposition" value="{{old('disposition')}}" />
                                </div>
                            </div>
                        </div>

                        <div class="category form-category"><star>*</star> Champ obligatoire</div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-rose btn-fill btn-wd" value="Sauvegarder">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="LoginValidation" action="{{ url('evaluations') }}" method="post">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter une evaluation</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom
                                        <star>*</star>
                                    </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Titre" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Type</label>
                                    <select class="selectpicker" required="" name="type" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected value="">-- select --</option>
                                        <option value="a chaud"> A chaud </option>
                                        <option value="a froid"> A froid </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Session <star>*</star></label>
                                    <select class="selectpicker" required="" name="session" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected value="">-- select --</option>
                                        @foreach ($sessions as $session)
                                            <option value="{{ $session->id }}"> {{ $session->nom }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="category form-category">
                            <star>*</star> Champ obligatoire</div>
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
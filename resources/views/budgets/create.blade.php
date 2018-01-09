@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card" style="overflow: auto;">
                <form id="" action="{{ url('budgets') }}" method="post" class="col-md-10 col-md-offset-1">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter les budgets</h4>
                        <div class="row">
                            <!-- <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom
                                        <star>*</star>
                                    </label>
                                    <input class="form-control" name="nom" type="text" placeholder="Titre" />
                                </div>
                            </div>  -->
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Session<star>*</star> </label>
                                    <select class="form-control" id="sessionsList" name="session"  required>
                                        <option>-- select --</option>
                                        @foreach ($sessions as $s)
                                            <option value="{{ $s->id }}" > {{ $s->nom }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Montant(Dhs)
                                        <star>*</star>
                                    </label>
                                    <input class="form-control" name="montant" type="text" placeholder="Montant" />
                                </div>
                            </div> -->

                        </div>

                        <div id="budgets-wrap">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Libellé du budget </label>
                                        <input type="text" class="form-control" name="budgets[0][budget]" placeholder="libellé de budget" required="" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Montant prévu </label>
                                        <input type="number" class="form-control prevu" name="budgets[0][prevu]" placeholder="Prévu" min="0" required="" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Montant réalisé </label>
                                        <input type="number" class="form-control realise" name="budgets[0][realise]" placeholder="Réalisé" min="0" required="" />
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label">Ajustement </label>
                                        <input type="number" class="form-control ajustement"  name="budgets[0][ajustement]" placeholder="Ajustement" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label"> </label>
                                        <button type="button" class="btn btn-default addLine pull-right"><i class="fa fa-plus"></i></button>
                                    </div>
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
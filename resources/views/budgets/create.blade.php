@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <form id="surveyForm" action="{{ url('budgets') }}" method="post">
                    {{ csrf_field() }}
                    <div class="content">
                        <h4 class="title">Ajouter un budget</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nom
                                        <star>*</star>
                                    </label>
                                    <input class="form-control" name="nom" type="text" required="true" placeholder="Titre" />
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Session<star>*</star> </label>
                                    <select class="selectpicker" name="session" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" required="">
                                        <option disabled selected value="">-- select --</option>
                                        @foreach ($sessions as $session)
                                            <option value="{{ $session->id }}"> {{ $session->nom }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Montant(Dhs)
                                        <star>*</star>
                                    </label>
                                    <input class="form-control" name="montant" type="text" required="true" placeholder="Montant" />
                                </div>
                            </div>

                        </div>

                        <div id="budgets-wrap">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="budgets[0][budget]" placeholder="libellé de budget" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="budgets[0][prevu]" placeholder="Prévu" />
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="budgets[0][realise]" placeholder="Réalisé" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="budgets[0][ajustement]" placeholder="Ajustement" />
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-default addLine pull-right"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- The option field template containing an option field and a Remove button -->
                        <!--div class="form-group hide" id="optionTemplate">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="budget[]" placeholder="libellé de budget" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="prevu[]" placeholder="Prévu" />
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="realise[]" placeholder="Réalisé" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="ajustement[]" placeholder="Ajustement" />
                                </div>
                                
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-default removeButton pull-right"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div-->

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
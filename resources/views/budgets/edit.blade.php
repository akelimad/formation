<form class="allInputsFormValidation" action="{{ url('budgetsSession/'.$session->id) }}" method="post">
    <input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}
    <div class="content">
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
                        <option value="{{ $session->id }}" > {{ $session->nom }} </option>
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

        <div id="addLine-wrap">
            @foreach($sess_budgets as $budget)
            <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Libellé du budget </label>
                        <input type="text" class="form-control" name="@if($first_budget->id == $budget->id) budgets[0][budget] @else budgets[{{$budget->id}}][budget] @endif" placeholder="libellé de budget" required="" value="{{$budget->budget}}" />
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Montant prévu </label>
                        <input type="number" class="form-control prevu" name="@if($first_budget->id == $budget->id) budgets[0][prevu] @else budgets[{{$budget->id}}][prevu] @endif" placeholder="Prévu" min="0" required="" value="{{$budget->prevu}}"/>
                    </div>
                    <div class="col-md-3">
                        <label class="control-label">Montant réalisé </label>
                        <input type="number" class="form-control realise" name="@if($first_budget->id == $budget->id) budgets[0][realise] @else budgets[{{$budget->id}}][realise] @endif" placeholder="Réalisé" min="0" required="" value="{{$budget->realise}}"/>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Ajustement </label>
                        <input type="number" class="form-control ajustement"  name="@if($first_budget->id == $budget->id) budgets[0][ajustement] @else budgets[{{$budget->id}}][ajustement] @endif" placeholder="Ajustement" value="{{$budget->ajustement}}"/>
                    </div>
                    <div class="col-md-1">
                        <label class="control-label"> &nbsp; </label>
                        <button type="button" class="btn btn-default pull-right {{$first_budget->id == $budget->id ? 'addLine':'deleteLine'}}"><i class="fa {{$first_budget->id == $budget->id ? 'fa-plus':'fa-minus'}}"></i></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="category form-category">
            <star>*</star> Champ obligatoire</div>
        <div class="text-center">
            <input type="submit" class="btn btn-rose btn-fill btn-wd" value="Sauvegarder">
        </div>
    </div>
</form>
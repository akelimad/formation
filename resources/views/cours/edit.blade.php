<form class="allInputsFormValidation" action="{{ url('cours/'.$c->id) }}" method="post" novalidate="novalidate">
    <input type="hidden" name="_method" value="PUT">
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
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Titre<star>*</star></label>
                    <input class="form-control" name="titre" type="text" required="required" placeholder="Titre" value="{{$c->titre}}" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Coordinateur<star>*</star> </label>
                    <select class="form-control" name="coordinateur"  required="required">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{$c->user_id == $user->id ? 'selected' : '' }} > {{ $user->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Devise <star>*</star></label>
                            <select class="form-control" name="devise" required="required">
                                <option value="DH" selected="selected">DH</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Budget <star>*</star></label>
                            <input class="form-control" name="prix" type="number" placeholder="Budget" value="{{$c->prix}}" required="required" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Durée(Nombre de jour) <star>*</star></label>
                    <input class="form-control" name="duree" type="number" placeholder="Nomre de jour" value="{{$c->duree}}" required="required" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Description</label>
                    <textarea class="form-control" name="description" placeholder="Description" rows="3">{{$c->description}}</textarea>
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
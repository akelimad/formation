<input type="hidden" name="id" value="{{ (isset($c->id)) ? $c->id : null }}">
{{ csrf_field() }}
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Titre<star>*</star></label>
                <input class="form-control" name="titre" type="text" required="required" placeholder="Titre" value="{{$c->titre}}" readonly="" />
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
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*" />
                <img src="{{asset('coursPhotos/'.$c->photo)}}" width="60" alt="">
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
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
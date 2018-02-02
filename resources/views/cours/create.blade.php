{{ csrf_field() }}
<input type="hidden" name="id">
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Titre <star>*</star></label>
                <input class="form-control" name="titre" type="text" required="required" placeholder="Titre" value="{{old('titre')}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Coordinateur <star>*</star> </label>
                <select class="form-control" name="coordinateur" required="required">

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{old('coordinateur') == $user->id ? 'selected':''}}> {{ $user->name }} </option>
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
                        <select class="form-control" name="devise" data-style="btn btn-primary btn-round" title="Single Select" data-size="7" required="required">
                            <option value="DH" selected="selected">DH</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Budget <star>*</star></label>
                        <input class="form-control" name="prix" type="number" placeholder="Budget" required="required" value="{{old('prix')}}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Durée(Nombre de jour) <star>*</star></label>
                <input class="form-control" name="duree" type="number" placeholder="Nomre de jour" required="required" value="{{old('duree')}}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Support</label>
                <input type="file" name="support" class="form-control" accept=".pdf,.doc, docx, .pptx, .ppt" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description" rows="3"> {{old('description')}}</textarea>
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
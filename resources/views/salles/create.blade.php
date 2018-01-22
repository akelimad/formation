{{ csrf_field() }}
<input type="hidden" name="id">
<div class="content">
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
</div>
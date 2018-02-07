<input type="hidden" name="id">
{{ csrf_field() }}
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label for="civilite" class="control-label">Civilite <star>*</star></label>
                <select name="civilite" id="civilite" class="form-control">
                    <option value="Mr">Mr</option>
                    <option value="Mme">Mme</option>
                    <option value="Mlle">Mlle</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Nom <star>*</star></label>
                <input class="form-control" name="nom" type="text" required="" placeholder="Nom" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Prénom <star>*</star></label>
                <input class="form-control" name="last_name" type="text" required="" placeholder="Prénom" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Email <star>*</star></label>
                <input class="form-control" name="email" type="email" required="" placeholder="example@gmail.com" />
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
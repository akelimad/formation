{{ csrf_field() }}
<input type="hidden" name="id">
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Nom(unique)<star>*</star></label>
                <input class="form-control" name="name" type="text" required="true" placeholder="create_users" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Le nom affiché</label>
                <input class="form-control" name="display_name" type="text" placeholder="ajout d'utilisateurs" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Description</label>
                <textarea name="description" id="" rows="2" class="form-control" placeholder="description de la permission"></textarea>
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
{{ csrf_field() }}
<input type="hidden" name="id">
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Nom(unique)<star>*</star></label>
                <input class="form-control" name="name" type="text" required="true" placeholder="unique comme Admin" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Le nom affiché</label>
                <input class="form-control" name="display_name" type="text" placeholder="comme Utilisateur Administrateur" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Description</label>
                <textarea name="description" id="" rows="2" class="form-control" placeholder="description du rôle"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Permissions</label>
                <div class="row">
                @foreach($permissions as $p)
                    <div class="col-sm-3">
                        <label class="checkbox-wrap">
                            <input type="checkbox" value="{{$p->id}}" name="permissions[]">{{$p->name}}
                            <span class="checkmark"></span>
                        </label>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
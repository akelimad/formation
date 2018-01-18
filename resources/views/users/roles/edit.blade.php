<form class="allInputsFormValidation" action="{{ url('utilisateurs/roles/'.$role->id) }}" method="post" novalidate="novalidate">
    <input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Nom(unique)<star>*</star></label>
                    <input class="form-control" name="name" type="text" required="true" placeholder="unique comme Admin" value="{{$role->name}}" readonly="" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Le nom affiché</label>
                    <input class="form-control" name="display_name" type="text" placeholder="comme Utilisateur Administrateur" value="{{$role->display_name}}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Description</label>
                    <textarea name="description" id="" rows="2" class="form-control" placeholder="description du rôle">{{$role->description}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Permissions</label>
                        @foreach($permissions as $p)
                            <div class="col-sm-2">
                                <label class="checkbox-wrap">
                                    <input type="checkbox"  value="{{$p->id}}" name="permissions[]" {{in_array($p->id, $role_perms) ? 'checked':''}} >{{$p->name}}
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        @endforeach
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
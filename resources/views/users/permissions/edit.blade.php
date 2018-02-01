<input type="hidden" name="id" value="{{ (isset($p->id)) ? $p->id : null }}">
{{ csrf_field() }}
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Nom(unique)<star>*</star></label>
                <input class="form-control" name="name" type="text" required="true" placeholder="create_users" value="{{$p->name}}" readonly="" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Le nom affiché</label>
                <input class="form-control" name="display_name" type="text" placeholder="ajout d'utilisateurs" value="{{$p->display_name}}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Description</label>
                <textarea name="description" id="" rows="2" class="form-control" placeholder="description de la permission"> {{$p->description}} </textarea>
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
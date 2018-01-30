<input type="hidden" name="id" value="{{ (isset($p->id)) ? $p->id : null }}">
{{ csrf_field() }}
<div class="">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Nom <star>*</star></label>
                <input class="form-control" name="nom" type="text" required="" placeholder="Nom" value="{{ $p->name }}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Email <star>*</star></label>
                <input class="form-control" name="email" type="email" required="" placeholder="example@gmail.com" value="{{ $p->email }}"/>
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
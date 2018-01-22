
<input type="hidden" name="id" value="{{ (isset($p->id)) ? $p->id : null }}">
{{ csrf_field() }}
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Nom complet <star>*</star> </label>
                <input class="form-control" name="nom" type="text" required="true" placeholder="Nom" required="required" value="{{$p->nom}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Code <star>*</star></label>
                <input type="text" name="code" class="form-control"  placeholder="Code"  readonly="" required="" value="{{$p->code}}"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Type <star>*</star></label>
                <select class="form-control" id="type" name="type" required="">
                    <option value="Cabinet" {{$p->type == 'Cabinet' ? 'selected':''}}>Cabinet</option>
                    <option value="Institution Etatique" {{$p->type == 'Institution Etatique' ? 'selected':''}}>Institution Etatique</option>
                    <option value="Ecole" {{$p->type == 'Ecole' ? 'selected':''}}>Ecole</option>
                    <option value="Autres" {{$p->type == 'Autres' ? 'selected':''}}>Autres</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Spécialité <star>*</star></label>
                <select class="form-control" id="specialite" name="specialite" required="">
                    <option value="RH" {{$p->specialite == 'RH' ? 'selected':''}}>RH</option>
                    <option value="Informatique" {{$p->specialite == 'Informatique' ? 'selected':''}}>Informatique</option>
                    <option value="Bureautique" {{$p->specialite == 'Bureautique' ? 'selected':''}}>Bureautique</option>
                    <option value="Soft Skills" {{$p->specialite == 'Soft Skills' ? 'selected':''}}>Soft Skills</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">N° de téléphone <star>*</star></label>
                <input class="form-control" name="tel" type="text" placeholder="N° de téléphone"  required="required" value="{{ $p->tel }}" minlength="10" maxlength="10"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">N° de Fax <star>*</star></label>
                <input class="form-control" name="fax" type="text" placeholder="N° de Fax"  required="required" value="{{ $p->fax }}" minlength="10" maxlength="10"/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Adresse electronique <star>*</star></label>
                <input class="form-control" name="email" type="email" placeholder="Adresse electronique"   required="required" value="{{ $p->email }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Personne de premier contact <star>*</star></label>
                <input class="form-control" name="personne_contacter" type="text" placeholder="Personne de premier contact" required="required" value="{{ $p->personne_contacter }}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Type d'entreprise</label>
                <input class="form-control" name="type_entreprise" type="text" placeholder="Type d'entreprise"  value="{{ $p->type_entreprise }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Qualification</label>
                <input class="form-control" name="qualification" type="text" placeholder="Personne de premier contact" value="{{ $p->qualification }}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Commentaire</label>
                <textarea class="form-control" name="commentaire" placeholder="Commentaire" rows="3">{{ $p->commentaire }}</textarea>
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
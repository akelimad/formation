<form class="allInputsFormValidation" method="post" >
    {{ csrf_field() }}
    <div class="content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <span><strong>Attention !</strong> {{ $error }}</span>
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Nom complet <star>*</star> </label>
                    <input class="form-control" name="nom" type="text"  placeholder="Nom" value="{{ old('nom') }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">Code <star>*</star></label>
                    <input type="text" name="code" class="form-control"  placeholder="Code" value="{{$code}}" readonly="" required="" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">Type <star>*</star></label>
                    <select class="form-control" name="type" required="required">
                        <option value="Cabinet" {{old('type') == 'Cabinet' ? 'selected':''}}>Cabinet</option>
                        <option value="Institution Etatique" {{old('type') == 'Institution Etatique' ? 'selected':''}}>Institution Etatique</option>
                        <option value="Ecole" {{old('type') == 'Ecole' ? 'selected':''}}>Ecole</option>
                        <option value="Autres" {{old('type') == 'Autres' ? 'selected':''}}>Autres</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">Spécialité <star>*</star></label>
                    <select class="form-control" name="specialite" data-style="btn btn-primary btn-round" required="required">
                        <option value="RH">RH</option>
                        <option value="Informatique" {{old('specialite') == 'Informatique' ? 'selected':''}} >Informatique</option>
                        <option value="Bureautique" {{old('specialite') == 'Bureautique' ? 'selected':''}}>Bureautique</option>
                        <option value="Soft Skills" {{old('specialite') == 'Soft Skills' ? 'selected':''}}>Soft Skills</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">N° de téléphone <star>*</star></label>
                    <input class="form-control" name="tel" type="tel" placeholder="0600000000" required="required" pattern="[0-9]{10}" value="{{ old('tel') }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">N° de Fax <star>*</star></label>
                    <input class="form-control" name="fax" type="tel" placeholder="0500000000" required="required" pattern="[0-9]{10}" value="{{ old('fax') }}"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Adresse electronique <star>*</star></label>
                    <input class="form-control" name="email" type="email" email="true" placeholder="Adresse electronique" required="required" value="{{ old('email') }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Personne de premier contact <star>*</star></label>
                    <input class="form-control" name="personne_contacter" type="text" placeholder="Personne de premier contact" required="required"  value="{{ old('personne_contacter') }}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Type d'entreprise</label>
                    <input class="form-control" name="type_entreprise" type="text" placeholder="Type d'entreprise" value="{{ old('type_entreprise') }}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Qualification</label>
                    <input class="form-control" name="qualification" type="text" placeholder="Personne de premier contact" value="{{ old('qualification') }}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Commentaire</label>
                    <textarea class="form-control" name="commentaire" placeholder="Commentaire" rows="3">{{old('commentaire')}}</textarea>
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
<form class="allInputsFormValidation" id="editPrestataireForm" method="post" novalidate="novalidate">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id">
    {{ csrf_field() }}
    <div class="content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    
                </div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Nom complet <star>*</star> </label>
                    <input class="form-control" name="nom" type="text" required="true" placeholder="Nom" required="required" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">Code <star>*</star></label>
                    <input type="text" name="code" class="form-control"  placeholder="Code"  readonly="" required="" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">Type <star>*</star></label>
                    <select class="form-control" id="type" name="type" required="">
                        <option value="Cabinet" >Cabinet</option>
                        <option value="Institution Etatique" >Institution Etatique</option>
                        <option value="Ecole" >Ecole</option>
                        <option value="Autres" >Autres</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="label-control">Spécialité <star>*</star></label>
                    <select class="form-control" id="specialite" name="specialite" required="">
                        <option value="RH" >RH</option>
                        <option value="Informatique" selected="">Informatique</option>
                        <option value="Bureautique" >Bureautique</option>
                        <option value="Soft Skills" >Soft Skills</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">N° de téléphone <star>*</star></label>
                    <input class="form-control" name="tel" type="text" placeholder="N° de téléphone"  required="required" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">N° de Fax <star>*</star></label>
                    <input class="form-control" name="fax" type="text" placeholder="N° de Fax"  required="required" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Adresse electronique <star>*</star></label>
                    <input class="form-control" name="email" type="email" placeholder="Adresse electronique"   required="required" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Personne de premier contact <star>*</star></label>
                    <input class="form-control" name="personne_contacter" type="text" placeholder="Personne de premier contact" required="required" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Type d'entreprise</label>
                    <input class="form-control" name="type_entreprise" type="text" placeholder="Type d'entreprise"  />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Qualification</label>
                    <input class="form-control" name="qualification" type="text" placeholder="Personne de premier contact" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Commentaire</label>
                    <textarea class="form-control" name="commentaire" placeholder="Commentaire" rows="3"></textarea>
                </div>
            </div>
        </div>

        <div class="category form-category">
            <star>*</star> Champ obligatoire</div>
        <div class="text-center">
            <button type="submit" class="btn btn-rose btn-fill btn-wd updatePrestataire" value="">Sauvegarder</button>
        </div>
    </div>
</form>
<div class="row">
<div class="col-md-6">
    <div class="form-group label-floating">
        <label class="control-label">Nom complet  </label>
        <p class="form-control " id="nom">{{$prestataire->nom}}</p>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="label-control">Code </label>
        <p class="form-control" id="code">{{$prestataire->code}}</p>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-6">
    <div class="form-group">
        <label class="label-control">Type </label>
        <p class="form-control" id="type">{{$prestataire->type}}</p>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="label-control">Spécialité </label>
        <p class="form-control" id="specialite">{{$prestataire->specialite}}</p>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-6">
    <div class="form-group label-floating">
        <label class="control-label">N° de téléphone </label>
        <p class="form-control" id="tel">{{$prestataire->tel}}</p>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group label-floating">
        <label class="control-label">N° de Fax </label>
        <p class="form-control" id="fax">{{$prestataire->fax}}</p>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-6">
    <div class="form-group label-floating">
        <label class="control-label">Adresse electronique </label>
        <p class="form-control" id="email">{{$prestataire->email}}</p>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group label-floating">
        <label class="control-label">Personne de premier contact </label>
        <p class="form-control" id="personne_contacter"> {{$prestataire->personne_contacter}} </p>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-6">
    <div class="form-group label-floating">
        <label class="control-label">Type d'entreprise</label>
        <p class="form-control" id="type_entreprise"> {{$prestataire->type_entreprise}} </p>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group label-floating">
        <label class="control-label">Qualification</label>
        <p class="form-control" id="qualification"> {{$prestataire->qualification}} </p>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
    <div class="form-group label-floating">
        <label class="control-label">Commentaire</label>
        <p class="form-control" id="commentaire"> {{$prestataire->commentaire}}  </p>
    </div>
</div>
</div>
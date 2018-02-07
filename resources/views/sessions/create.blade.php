{{ csrf_field() }}
<input type="hidden" name="id">
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Nom<star>*</star> </label>
                <input class="form-control" name="nom" type="text" required="" placeholder="Titre" value="{{ old('nom') }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Cours<star>*</star> </label>
                        <select class="select2 form-control" name="cour"  required="required">
                            @foreach ($cours as $cour)
                                <option value="{{ $cour->id }}" {{$cour->id == old('cour') ? 'selected': ''}} > {{ $cour->titre }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Formateur<star>*</star> </label>
                        <select class="form-control" name="formateur"  required="">
                            @foreach ($formateurs as $formateur)
                                <option value="{{ $formateur->id }}" {{$formateur->id == old('formateur') ? 'selected': ''}} > {{ $formateur->nom }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Date de début <star>*</star></label>
                <input type="text" name="start" data-date-format="DD/MM/YYYY HH:mm" class="form-control datetimepicker" required="required"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Date de fin <star>*</star> </label>
                <input type="text" name="end" data-date-format="DD/MM/YYYY HH:mm" class="form-control datetimepicker" required="required" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Lieu <star>*</star></label>
                <input class="form-control" name="lieu" type="text" placeholder="Lieu" value="{{ old('lieu') }}" required="required" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Methode <star>*</star></label>
                        <select class="form-control" name="methode" required="required">
                            <option disabled selected>-- select --</option>
                            <option value="Salle de classe" selected="">Salle de classe</option>
                            <option value="Autoformation">Autoformation</option>
                            <option value="WebEx">WebEx</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Statut <star>*</star></label>
                        <select class="form-control" name="statut"  required="required">
                            <option disabled selected>-- select --</option>
                            <option value="Aprobation en attente" >Aprobation en attente</option>
                            <option value="Programmé" selected="">Programmé</option>
                            <option disabled="" value="" >Terminé</option>
                            <option value="Annulé" >Annulé</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating participants">
                <label class="control-label">Participants <star>*</star></label>
                <select class="js-example-basic-multiple form-control" name="participants[]" multiple="multiple" required="required">
                    @foreach ($participants as $p)
                        <option value="{{$p->id}}" title="{{$p->email}}">{{$p->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Salle <star>*</star></label>
                <select class="form-control" required="required" name="salle" data-style="btn btn-primary btn-round" title="Select" data-size="7">
                    @foreach ($salles as $salle)
                        <option value="{{ $salle->id }}" {{$salle->id == old('salle') ? 'selected': ''}} > {{ $salle->numero }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description" rows="3">{{ old('description') }}</textarea>
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>

<script>
    $(function(){
        $('.js-example-basic-multiple').select2({
            multiple: true,
            width: "100%",
            'placeholder':'Selectionnez',
        });
        demo.initFormExtendedDatetimepickers();
    })
</script>
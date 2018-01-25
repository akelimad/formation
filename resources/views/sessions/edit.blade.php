<input type="hidden" name="id" value="{{ (isset($s->id)) ? $s->id : null }}">
{{ csrf_field() }}
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Nom<star>*</star> </label>
                <input class="form-control" name="nom" type="text" placeholder="Titre"  value="{{$s->nom}}" readonly=""/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Cours<star>*</star> </label>
                        <select class="form-control" name="cour" data-style="btn btn-primary btn-round" title="Select" data-size="7" required="">
                            <option disabled selected value="">-- select --</option>
                            @foreach ($cours as $cour)
                                <option value="{{ $cour->id}}" {{$cour->id == $s->cour->id ? 'selected':''}} > {{ $cour->titre }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Formateur<star>*</star> </label>
                        <select class="form-control" name="formateur" data-style="btn btn-primary btn-round" title="Select" data-size="7" required="">
                            <option disabled selected value="">-- select --</option>
                            @foreach ($formateurs as $formateur)
                                <option value="{{ $formateur->id }}" {{$formateur->id == $s->formateur->id ? 'selected':''}} > {{ $formateur->nom }} </option>
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
                <label class="label-control">Date de début <star>*</star> </label>
                <input type="text" name="start" data-date-format="DD/MM/YYYY HH:mm" class="form-control datetimepicker" required="required" value="{{ Carbon\Carbon::parse($s->start)->format('d/m/Y H:i') }}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="label-control">Date de fin <star>*</star> </label>
                <input type="text" name="end" data-date-format="DD/MM/YYYY HH:mm" class="form-control datetimepicker" required="required" value="{{ Carbon\Carbon::parse($s->end)->format('d/m/Y H:i') }}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Lieu <star>*</star></label>
                <input class="form-control" name="lieu" type="text" placeholder="Lieu" value="{{$s->lieu}}" required="required" required="required" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Methode <star>*</star></label>
                        <select class="form-control" name="methode" data-style="btn btn-primary btn-round" title="Select" data-size="7" required="required">
                            <option disabled selected>-- select --</option>
                            <option value="Salle de classe" {{$s->methode == 'Salle de classe' ? 'selected':''}} >Salle de classe</option>
                            <option value="Autoformation" {{$s->methode == 'Autoformation' ? 'selected':''}} >Autoformation</option>
                            <option value="WebEx" {{$s->methode == 'WebEx' ? 'selected':''}} >WebEx</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Statut <star>*</star></label>
                        <select class="form-control" name="statut" data-style="btn btn-primary btn-round" title="Select" data-size="7" required="required">
                            <option disabled selected>-- select --</option>
                            <option value="Aprobation en attente" {{$s->statut == 'Aprobation en attente' ? 'selected': ''}} >Aprobation en attente</option>
                            <option value="Programmé" {{$s->statut == 'Programmé' ? 'selected': ''}} >Programmé</option>
                            <option value="Terminé" {{$s->statut == 'Terminé' ? 'selected': ''}} >Terminé</option>
                            <option value="Annulé" {{$s->statut == 'Annulé' ? 'selected': ''}} >Annulé</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating participants">
                <label class="control-label">Participants prévus</label>
                @foreach ($s->participants as $par)
                    @if(in_array($par->id, $prevus_ids))
                    <span class="badge" title="{{$par->email}}">{{$par->nom}}</span>
                    @endif
                @endforeach
            </div>
            <div class="form-group label-floating participants">
                <label class="control-label">Participants présents <star>*</star></label>
               
                <select class="js-example-basic-multiple form-control" name="participants[]" multiple="multiple" required="required">
                    @foreach ($participants as $p)
                        <option value="{{$p->id}}" title="{{$p->email}}" @if (in_array($p->id, $present_ids)) selected @endif > {{$p->nom}} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Salle <star>*</star></label>
                <select class="form-control" required="required" name="salle" data-style="btn btn-primary btn-round" title="Select" data-size="7">
                    @foreach ($salles as $salle)
                        <option value="{{ $salle->id }}" {{$salle->id == $s->salle->id ? 'selected':''}} > {{ $salle->numero }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description" rows="3">{{$s->description}}</textarea>
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
{{ csrf_field() }}
<input type="hidden" name="id">
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Nom complet
                    <star>*</star>
                </label>
                <input class="form-control" name="nom" type="text" required="required" placeholder="Nom" value="{{old('nom')}}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Type <star>*</star></label>
                <select name="type" id="formateur-type" class="form-control" required="required">
                    <option value="Interne">Interne</option>
                    <option value="Externe">Externe</option>
                </select>
            </div>
            <div class="form-group prestataires-select" style="display: none;">
                <label class="label-control">Prestataire <star>*</star></label>
                <select class="form-control" name="prestataire_id" required="required">
                    <option value=""> == Select ==</option>
                    @foreach($prestataires as $p)
                        <option value="{{ $p->id }}"> {{ $p->nom }} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Email <star>*</star></label>
                <input class="form-control" name="email" type="email" placeholder="example@gmail.com" required="required" value="{{old('email')}}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Tel <star>*</star></label>
                <input class="form-control" name="tel" type="tel" placeholder="0600000000" required="required" pattern="[0-9]{10}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Qualification <star>*</star></label>
                <input class="form-control" name="qualification" type="text" placeholder="Qualification" required="required" value="{{old('qualification')}}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Expertise <star>*</star></label>
                <input class="form-control" name="expertise" type="text" placeholder="Expertise" required="required" value="{{old('expertise')}}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Autres</label>
                <textarea name="autres" id="" class="form-control" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label">Importer le C.V en pièce jointe</label>
                <input type="file" name="cv" class="form-control" accept=".docx,.pdf" >    
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 ">
            <label class="control-label rating">Rating</label>
        </div>
        <div class="col-md-10">
            <div class="stars quality">
                <input class="star star-5-q" id="star-5-q" type="radio" name="rating" value="5" />
                <label class="star star-5-q" for="star-5-q" title=" Qualité 5/5"></label>
                <input class="star star-4-q" id="star-4-q" type="radio" name="rating" value="4"/>
                <label class="star star-4-q" for="star-4-q" title=" Qualité 4/5"></label>
                <input class="star star-3-q" id="star-3-q" type="radio" name="rating" value="3"/>
                <label class="star star-3-q" for="star-3-q" title=" Qualité 3/5"></label>
                <input class="star star-2-q" id="star-2-q" type="radio" name="rating" value="2"/>
                <label class="star star-2-q" for="star-2-q" title=" Qualité 2/5"></label>
                <input class="star star-1-q" id="star-1-q" type="radio" name="rating" value="1"/>
                <label class="star star-1-q" for="star-1-q" title=" Qualité 1/5"></label>
            </div>
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>

<script>
    $(function() {
        $("#formateur-type").on('change', function(){
            if($(this).val() === "Externe"){
                $(".prestataires-select").show()
                $(".prestataires-select select").prop("required", true);
            }else{
                $(".prestataires-select").hide()
                $(".prestataires-select select").prop("required", false);
            }
        })
        $("#formateur-type").change()
    })
</script>
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Nom complet</label>
            <p class="form-control"> {{ $f->nom }} </p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Type </label>
            <p class="form-control"> {{ $f->type }} </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Email </label>
            <p class="form-control"> {{ $f->email }} </p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Tel </label>
            <p class="form-control"> {{ $f->tel }} </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Qualification </label>
            <p class="form-control"> {{ $f->qualification }} </p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group label-floating">
            <label class="control-label">Expertise </label>
            <p class="form-control"> {{ $f->expertise }} </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating">
            <label class="control-label">Autres</label>
            <p class="form-control"> {{ $f->autres }} </p>
        </div>
    </div>
</div>
<div class="row">
    @if(!empty($f->cv))
        <div class="col-md-12">
            <div class="form-group label-floating">
                <label class="control-label"> &nbsp; </label>
                <a href="{{asset('cvs/'.$f->cv)}}" class="form-control" style="color: #5e9ef5" target="_blank" ><i class="fa fa-download"></i> Télécharger le C.V </a>
            </div>
        </div>
    @endif   
</div>
<div class="row">
    <div class="col-md-2 ">
        <label class="control-label rating">Rating</label>
    </div>
    <div class="col-md-10">
        <div class="stars quality">
            <input class="star star-5-q" id="star-5-q" type="radio" name="rating" value="5" {{$f->rating/20 == 5 ? 'checked':''}} />
            <label class="star star-5-q" for="star-5-q" title=" Qualité 5/5"></label>
            <input class="star star-4-q" id="star-4-q" type="radio" name="rating" value="4" {{$f->rating/20 == 4 ? 'checked':''}} />
            <label class="star star-4-q" for="star-4-q" title=" Qualité 4/5"></label>
            <input class="star star-3-q" id="star-3-q" type="radio" name="rating" value="3" {{$f->rating/20 == 3 ? 'checked':''}} />
            <label class="star star-3-q" for="star-3-q" title=" Qualité 3/5"></label>
            <input class="star star-2-q" id="star-2-q" type="radio" name="rating" value="2" {{$f->rating/20 == 2 ? 'checked':''}} />
            <label class="star star-2-q" for="star-2-q" title=" Qualité 2/5"></label>
            <input class="star star-1-q" id="star-1-q" type="radio" name="rating" value="1" {{$f->rating/20 == 1 ? 'checked':''}} />
            <label class="star star-1-q" for="star-1-q" title=" Qualité 1/5"></label>
        </div>
    </div>
</div>
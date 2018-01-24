    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Numéro</label>
                <p class="form-control"> {{ $s->numero }} </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Capacité</label>
                <p class="form-control"> {{ $s->capacite }} </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Equipements</label>
                <p class="form-control"> {{ $s->equipements }} </p>
            </div>
             <div class="form-group label-floating">
                <label class="control-label">Disposition</label>
                <p class="form-control"> {{ $s->disposition }} </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <label class="control-label">Photo</label>
                @if($s->photo)
                    <img src="{{asset('sallePhotos/'.$s->photo)}}" alt="" class="img-responsive">
                @else
                    <img src="{{asset('assets/img/missing-photo.png')}}" alt="" class="img-responsive">
                @endif
            </div>
        </div>
    </div>
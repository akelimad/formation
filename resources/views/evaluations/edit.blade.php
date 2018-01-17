<form class="allInputsFormValidation" action="{{ url('evaluations/'.$e->id) }}" method="post" novalidate="novalidate">
    <input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Nom <star>*</star></label>
                    <input class="form-control" name="nom" type="text" required="true" placeholder="Titre" value="{{$e->nom}}" required="required"  />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Type  <star>*</star></label>
                    <select class="form-control" required="required" name="type">
                        <option disabled value="">-- select --</option>
                        <option value="a-chaud" {{$e->type = 'a-chaud' ? 'selected':''}}> A chaud </option>
                        <option value="a-froid" {{$e->type = 'a-froid' ? 'selected':''}}> A froid </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Session <star>*</star></label>
                    <select class="form-control session" required="required" name="session" >
                        <option disabled value="">-- select --</option>
                        @foreach ($sessions as $session)

                            <option value="{{ $session->id }}" {{$e->session = $session->id ? 'selected':''}} > {{ $session->nom }} </option>
                        @endforeach
                    </select>
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
<form class="allInputsFormValidation" action="{{ url('evaluations') }}" method="post" novalidate="novalidate">
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
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Nom
                        <star>*</star>
                    </label>
                    <input class="form-control" name="nom" type="text" required="true" placeholder="Titre" value="{{old('nom')}}" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Type <star>*</star></label>
                    <select class="form-control" required="" name="type" >
                        <option disabled selected value="">-- select --</option>
                        <option value="a-chaud" {{old('type') == 'a-chaud' ? 'selected':''}}> A chaud </option>
                        <option value="a-froid" {{old('type') == 'a-froid' ? 'selected':''}}> A froid </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group label-floating">
                    <label class="control-label">Session <star>*</star></label>
                    <select class="form-control" required="" name="session" >
                        <option disabled selected value="">-- select --</option>
                        @foreach ($sessions as $session)
                            <option value="{{ $session->id }}" {{old('session') == $session->id ? 'selected':''}}> {{ $session->nom }} </option>
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
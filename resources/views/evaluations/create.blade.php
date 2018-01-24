<input type="hidden" name="id">
{{ csrf_field() }}
<div class="content">
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
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
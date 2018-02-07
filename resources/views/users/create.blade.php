{{ csrf_field() }}
<input type="hidden" name="id">
<div class="content">
    <div class="form-group">
        <label for="civilite" class="col-md-3 control-label">Civilite <star>*</star></label>
        <div class="col-md-8">
            <select name="civilite" id="civilite" class="form-control">
                <option value="Mr">Mr</option>
                <option value="Mme">Mme</option>
                <option value="Mlle">Mlle</option>
            </select>
        </div>
    </div>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-3 control-label">Nom <star>*</star></label>
        <div class="col-md-8">
            <input id="name" type="text" class="form-control" name="name" required="" value="{{ old('name') }}">

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
        <label for="last_name" class="col-md-3 control-label">Prénom <star>*</star></label>
        <div class="col-md-8">
            <input id="last_name" type="text" class="form-control" name="last_name" required="" value="{{ old('last_name') }}">

            @if ($errors->has('last_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-3 control-label">Addresse email <star>*</star></label>

        <div class="col-md-8">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-3 control-label">Mot de passe <star>*</star></label>

        <div class="col-md-8">
            <input id="password" type="password" class="form-control" name="password" required="">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="col-md-3 control-label">Confirmation <star>*</star></label>

        <div class="col-md-8">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required="required" equalTo="#password">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
        <label for="role" class="col-md-3 control-label">Rôle <star>*</star></label>

        <div class="col-md-8">
            <select name="role" id="role" class="form-control" required="">
                <option value="0" disabled="">=== Selectionnez ===</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}"> {{$role->name}} </option>
                @endforeach 
            </select>

            @if ($errors->has('roles'))
                <span class="help-block">
                    <strong>{{ $errors->first('roles') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="category form-category"><star>*</star> Champ obligatoire</div>
</div>
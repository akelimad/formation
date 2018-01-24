<input type="hidden" name="id" value="{{ (isset($user->id)) ? $user->id : null }}">
{{ csrf_field() }}
<div class="content">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-3 control-label">Nom complet <star>*</star></label>
        <div class="col-md-8">
            <input id="name" type="text" class="form-control" name="name" required="" value="{{ $user->name }}">

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-3 control-label">Addresse email <star>*</star></label>

        <div class="col-md-8">
            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required="" >

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-3 control-label">Mot de passe </label>

        <div class="col-md-8">
            <input id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="col-md-3 control-label">Confirmation </label>

        <div class="col-md-8">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" data-match="#password">

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
                <option value="0" disabled="" selected="">=== Selectionnez ===</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}" {{in_array($role->id, $roles_ids) ? 'selected':''}}> {{$role->name}} </option>
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
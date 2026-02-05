<form method="POST" id="form_block" name="form_block" action="{{ route('users.store') }}" style="width:100%;">
    @csrf
    <div class="row">
        <div class="title-box">{{ module_lang('Users', 'form.user_data') }}</div>

        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="first_name">{{ module_lang('Users', 'form.first_name') }}</label>
                <input type="text" autocomplete="off" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="{{ module_lang('Users', 'placeholder.first_name') }}" required autofocus tabindex="1" value="{{ old('first_name') }}" />
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="stand_name">{{ module_lang('Users', 'form.stand_name') }}</label>
                <input type="text" autocomplete="off" class="form-control" id="stand_name" name="stand_name" placeholder="{{ module_lang('Users', 'placeholder.stand_name') }}" tabindex="3" value="{{ old('stand_name') }}" />
            </div>
            <div class="form-group">
                <label for="phone">{{ module_lang('Users', 'form.phone') }}</label>
                <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="{{ module_lang('Users', 'placeholder.phone') }}" tabindex="5" value="{{ old('phone') }}" />
            </div>
            <div class="light-bg">
                <div class="form-group">
                    <label for="fileupload">{{ module_lang('Users', 'form.upload_photo') }}</label>
                    <input type="file" id="fileupload" name="fileupload" class="form-control" accept="image/*" />
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="last_name">{{ module_lang('Users', 'form.last_name') }}</label>
                <input type="text" autocomplete="off" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="{{ module_lang('Users', 'placeholder.last_name') }}" required tabindex="2" value="{{ old('last_name') }}" />
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="symbol">{{ module_lang('Users', 'form.symbol') }}</label>
                <input type="text" autocomplete="off" class="form-control @error('symbol') is-invalid @enderror" id="symbol" name="symbol" placeholder="{{ module_lang('Users', 'placeholder.symbol') }}" maxlength="2" required tabindex="4" value="{{ old('symbol') }}" />
                @error('symbol')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="department">{{ module_lang('Users', 'form.department') }}</label>
                <input type="text" autocomplete="off" class="form-control" id="department" name="department" placeholder="{{ module_lang('Users', 'placeholder.department') }}" tabindex="6" value="{{ old('department') }}" />
            </div>
            <div class="form-group">
                <label for="description">{{ module_lang('Users', 'form.description') }}</label>
                <textarea type="text" autocomplete="off" class="form-control" id="description" name="description" placeholder="{{ module_lang('Users', 'placeholder.description') }}" tabindex="8" cols="5" rows="10">{{ old('description') }}</textarea>
            </div>
        </div>
        <p>&nbsp;</p>
        <hr />
        <div class="form-group">
            <label for="user_level">{{ module_lang('Users', 'form.user_level') }}</label><br />
            <div class="radio radio-success">
                @foreach($accessLevels as $access)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="{{ $access->level }}" id="upr_{{ $access->level }}" name="user_level" tabindex="7" {{ old('user_level') == $access->level ? 'checked' : '' }} required>
                        <label class="form-check-label" for="upr_{{ $access->level }}">{{ $access->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('user_level')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <hr />
        <p>&nbsp;</p>
        <div class="title-box">{{ module_lang('Users', 'form.login_data') }}</div>
        <div class="form-group">
            <label for="email">{{ module_lang('Users', 'form.email_login') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ module_lang('Users', 'placeholder.email') }}" autocomplete="off" required tabindex="9" value="{{ old('email') }}" />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">{{ module_lang('Users', 'form.password') }}</label>
            <input type="password" id="password" autocomplete="new-password" name="password" class="form-control @error('password') is-invalid @enderror" tabindex="10" required />
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="confirmpassword">{{ module_lang('Users', 'form.repeat_password') }}</label>
            <input type="password" id="confirmpassword" name="password_confirmation" class="form-control" tabindex="11" required />
        </div>
        <hr />
        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ module_lang('Users', 'form.add_user') }}</button> <button type="reset" class="btn btn-danger">{{ module_lang('Dashboard', 'common.reset') }}</button>
        </div>
    </div>
</form>

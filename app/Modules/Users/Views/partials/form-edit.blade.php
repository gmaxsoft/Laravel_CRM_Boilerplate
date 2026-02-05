<form method="POST" id="form_block" name="form_block" action="{{ route('users.update', $user->id) }}" style="width:100%;">
    @csrf
    <div class="row">
        <div class="title-box">{{ module_lang('Users', 'form.edit_user', ['name' => $user->first_name . ' ' . $user->last_name]) }}</div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="first_name">{{ module_lang('Users', 'form.first_name') }}</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="{{ module_lang('Users', 'placeholder.first_name') }}" required autofocus tabindex="1" value="{{ old('first_name', $user->first_name) }}">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="stand_name">{{ module_lang('Users', 'form.stand_name') }}</label>
                <input type="text" class="form-control" id="stand_name" name="stand_name" placeholder="{{ module_lang('Users', 'placeholder.stand_name') }}" tabindex="3" value="{{ old('stand_name', $user->stand_name) }}">
            </div>
            <div class="form-group">
                <label for="phone">{{ module_lang('Users', 'form.phone') }}</label>
                <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="{{ module_lang('Users', 'placeholder.phone') }}" tabindex="5" value="{{ old('phone', $user->phone) }}" />
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="last_name">{{ module_lang('Users', 'form.last_name') }}</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="{{ module_lang('Users', 'placeholder.last_name') }}" required tabindex="2" value="{{ old('last_name', $user->last_name) }}">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="symbol">{{ module_lang('Users', 'form.symbol') }}</label>
                <input type="text" class="form-control @error('symbol') is-invalid @enderror" id="symbol" name="symbol" placeholder="{{ module_lang('Users', 'placeholder.symbol') }}" maxlength="2" required tabindex="4" value="{{ old('symbol', $user->symbol) }}">
                @error('symbol')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="department">{{ module_lang('Users', 'form.department') }}</label>
                <input type="text" autocomplete="off" class="form-control" id="department" name="department" placeholder="{{ module_lang('Users', 'placeholder.department') }}" tabindex="6" value="{{ old('department', $user->department) }}" />
            </div>
            <div class="form-group">
                <label for="description">{{ module_lang('Users', 'form.description') }}</label>
                <textarea type="text" autocomplete="off" class="form-control" id="description" name="description" placeholder="{{ module_lang('Users', 'placeholder.description') }}" tabindex="8" cols="5" rows="10">{{ old('description', $user->description) }}</textarea>
            </div>
        </div>
        @if($canChangeLevel)
            <p>&nbsp;</p>
            <hr />
            <div class="form-group">
                <label for="user_level">{{ module_lang('Users', 'form.user_level') }}</label><br />
                <div class="radio radio-success">
                    @foreach($accessLevels as $access)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="{{ $access->level }}" id="upr_{{ $access->level }}" name="user_level" tabindex="7" {{ old('user_level', $user->user_level) == $access->level ? 'checked' : '' }}>
                            <label class="form-check-label" for="upr_{{ $access->level }}">{{ $access->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr />
            <p>&nbsp;</p>
        @endif
        <div class="title-box">{{ module_lang('Users', 'form.login_data') }}</div>
        <div class="form-group">
            <label for="email">{{ module_lang('Users', 'form.email_login') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ module_lang('Users', 'placeholder.email') }}" autocomplete="off" required tabindex="9" value="{{ old('email', $user->email) }}" />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <p>&nbsp;</p>
        <hr />
        <div class="form-group">
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-primary">{{ module_lang('Users', 'form.update') }}</button>
            <button type="button" class="btn btn-danger backtolist">{{ module_lang('Users', 'form.back_to_list') }}</button>
        </div>
    </div>
</form>

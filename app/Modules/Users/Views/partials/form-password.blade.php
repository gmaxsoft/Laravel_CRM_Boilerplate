<form method="POST" id="form_passwd" name="form_passwd" action="{{ route('users.update-password', $user->id) }}" style="width:100%;">
    @csrf
    <div class="title-box">{{ module_lang('Users', 'tabs.change_password') }}</div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
                <label for="password">{{ module_lang('Users', 'form.new_password') }}</label>
                <input type="password" id="password" name="password" autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" required />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <span>
                    <span class="error text-danger">Hasło jest wymagane!</span>
                </span>
            </div>
            <div class="form-group">
                <label for="confirmpassword">{{ module_lang('Users', 'form.repeat_password') }}</label>
                <input type="password" id="confirmpassword" name="password_confirmation" class="form-control" required />
            </div>
            <hr />
            <div class="form-group">
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}">
                <button type="submit" class="btn btn-primary">{{ module_lang('Users', 'form.change_password_btn') }}</button>
                <button type="button" class="btn btn-danger backtolist">{{ module_lang('Users', 'form.back_to_list') }}</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div>&nbsp;</div>
    </div>
</form>

<form method="POST" id="form_block" name="form_block" style="width:100%;">
    @csrf
    <div class="title-box">{{ module_lang('Access', 'form.title') }}</div>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label for="name">{{ module_lang('Access', 'form.name') }}</label>
                <input type="text" autocomplete="off" class="form-control @error('name') is-invalid @enderror" required id="name" name="name" placeholder="{{ module_lang('Access', 'form.placeholder_name') }}" value="{{ old('name') }}" autofocus tabindex="1" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="level">{{ module_lang('Access', 'form.level') }}</label>
                <input type="text" autocomplete="off" class="form-control @error('level') is-invalid @enderror" required id="level" name="level" placeholder="{{ module_lang('Access', 'form.placeholder_level') }}" value="{{ old('level') }}" autofocus tabindex="2" />
                @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <hr />
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ module_lang('Access', 'form.add') }}</button>
        <button type="reset" class="btn btn-danger">{{ module_lang('Dashboard', 'common.reset') }}</button>
    </div>
</form>

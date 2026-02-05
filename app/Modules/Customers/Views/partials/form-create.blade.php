<form method="POST" id="form_block" name="form_block" style="width:100%;" enctype="multipart/form-data">
    @csrf
    <div class="row nomarginrow">
        <div class="col-sm-12 col-md-4 col-lg-4 rightline">
            <div class="block-title">{{ module_lang('Customers', 'form.block_basic') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="customers_firmname">{{ module_lang('Customers', 'form.firmname') }}</label>
                    <input class="form-control @error('customers_firmname') is-invalid @enderror" autocomplete="off" id="customers_firmname" name="customers_firmname" value="{{ old('customers_firmname') }}" />
                    @error('customers_firmname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_legalform">{{ module_lang('Customers', 'form.legalform') }}</label>
                    <select class="form-control @error('customers_legalform') is-invalid @enderror" autocomplete="off" id="customers_legalform" name="customers_legalform">
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        <option value="Produkcja roślinna" {{ old('customers_legalform') == 'Produkcja roślinna' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.legalform_crop') }}</option>
                        <option value="Produkcja zwierzęca" {{ old('customers_legalform') == 'Produkcja zwierzęca' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.legalform_livestock') }}</option>
                        <option value="Usługodawca" {{ old('customers_legalform') == 'Usługodawca' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.legalform_services') }}</option>
                        <option value="Firma komunalna" {{ old('customers_legalform') == 'Firma komunalna' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.legalform_communal') }}</option>
                        <option value="Handel" {{ old('customers_legalform') == 'Handel' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.legalform_trade') }}</option>
                        <option value="Przemysł" {{ old('customers_legalform') == 'Przemysł' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.legalform_industry') }}</option>
                        <option value="Przetwórstwo" {{ old('customers_legalform') == 'Przetwórstwo' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.legalform_processing') }}</option>
                        <option value="Inne" {{ old('customers_legalform') == 'Inne' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.legalform_other') }}</option>
                    </select>
                    @error('customers_legalform')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_firstname">{{ module_lang('Customers', 'form.firstname') }} <span class="text-danger">*</span></label>
                    <input class="form-control @error('customers_firstname') is-invalid @enderror" required autocomplete="off" id="customers_firstname" name="customers_firstname" value="{{ old('customers_firstname') }}" />
                    @error('customers_firstname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_lastname">{{ module_lang('Customers', 'form.lastname') }} <span class="text-danger">*</span></label>
                    <input class="form-control @error('customers_lastname') is-invalid @enderror" required autocomplete="off" id="customers_lastname" name="customers_lastname" value="{{ old('customers_lastname') }}" />
                    @error('customers_lastname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_phone">{{ module_lang('Customers', 'form.phone') }} <span class="text-danger">*</span></label>
                    <input class="form-control @error('customers_phone') is-invalid @enderror" type="tel" required autocomplete="off" id="customers_phone" name="customers_phone" value="{{ old('customers_phone') }}" data-inputmask="'mask': '999999999'" maxlength="9" />
                    @error('customers_phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_email">{{ module_lang('Customers', 'form.email') }}</label>
                    <input class="form-control @error('customers_email') is-invalid @enderror" id="customers_email" type="email" autocomplete="off" name="customers_email" value="{{ old('customers_email') }}" />
                    @error('customers_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_rodo">{{ module_lang('Customers', 'form.rodo') }}</label>
                    <select class="form-control @error('customers_rodo') is-invalid @enderror" autocomplete="off" id="customers_rodo" name="customers_rodo">
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        <option value="Tak" {{ old('customers_rodo') == 'Tak' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.yes') }}</option>
                        <option value="Nie" {{ old('customers_rodo') == 'Nie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.no') }}</option>
                    </select>
                    @error('customers_rodo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_re_contact_date">{{ module_lang('Customers', 'form.re_contact_date') }}</label>
                    <input type="date" autocomplete="off" class="form-control @error('customers_re_contact_date') is-invalid @enderror" id="customers_re_contact_date" name="customers_re_contact_date" value="{{ old('customers_re_contact_date') }}" />
                    @error('customers_re_contact_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 rightline">
            <div class="block-title">{{ module_lang('Customers', 'form.block_address') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="customers_adres">{{ module_lang('Customers', 'form.address') }} <span class="text-danger">*</span></label>
                    <input class="form-control @error('customers_adres') is-invalid @enderror" required autocomplete="off" id="customers_adres" name="customers_adres" value="{{ old('customers_adres') }}" />
                    @error('customers_adres')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_city">{{ module_lang('Customers', 'form.city') }}</label>
                    <input class="form-control @error('customers_city') is-invalid @enderror" autocomplete="off" id="customers_city" name="customers_city" value="{{ old('customers_city') }}" />
                    @error('customers_city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_postcode">{{ module_lang('Customers', 'form.postcode') }}</label>
                    <input class="form-control @error('customers_postcode') is-invalid @enderror" autocomplete="off" id="customers_postcode" name="customers_postcode" value="{{ old('customers_postcode') }}" data-inputmask="'mask': '99-999'" maxlength="6" />
                    @error('customers_postcode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_area">{{ module_lang('Customers', 'form.area') }}</label>
                    <select class="form-control @error('customers_area') is-invalid @enderror" autocomplete="off" id="customers_area" name="customers_area">
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        <option value="Dolnośląskie" {{ old('customers_area') == 'Dolnośląskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_dolnoslaskie') }}</option>
                        <option value="Kujawsko-Pomorskie" {{ old('customers_area') == 'Kujawsko-Pomorskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_kujawsko_pomorskie') }}</option>
                        <option value="Lubelskie" {{ old('customers_area') == 'Lubelskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_lubelskie') }}</option>
                        <option value="Lubuskie" {{ old('customers_area') == 'Lubuskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_lubuskie') }}</option>
                        <option value="Łódzkie" {{ old('customers_area') == 'Łódzkie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_lodzkie') }}</option>
                        <option value="Małopolskie" {{ old('customers_area') == 'Małopolskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_malopolskie') }}</option>
                        <option value="Mazowieckie" {{ old('customers_area') == 'Mazowieckie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_mazowieckie') }}</option>
                        <option value="Opolskie" {{ old('customers_area') == 'Opolskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_opolskie') }}</option>
                        <option value="Podkarpackie" {{ old('customers_area') == 'Podkarpackie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_podkarpackie') }}</option>
                        <option value="Podlaskie" {{ old('customers_area') == 'Podlaskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_podlaskie') }}</option>
                        <option value="Pomorskie" {{ old('customers_area') == 'Pomorskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_pomorskie') }}</option>
                        <option value="Śląskie" {{ old('customers_area') == 'Śląskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_slaskie') }}</option>
                        <option value="Świętokrzyskie" {{ old('customers_area') == 'Świętokrzyskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_swietokrzyskie') }}</option>
                        <option value="Warmińsko-Mazurskie" {{ old('customers_area') == 'Warmińsko-Mazurskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_warminsko_mazurskie') }}</option>
                        <option value="Wielkopolskie" {{ old('customers_area') == 'Wielkopolskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_wielkopolskie') }}</option>
                        <option value="Zachodniopomorskie" {{ old('customers_area') == 'Zachodniopomorskie' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_zachodniopomorskie') }}</option>
                        <option value="Zagranica" {{ old('customers_area') == 'Zagranica' ? 'selected' : '' }}>{{ module_lang('Customers', 'form.area_zagranica') }}</option>
                    </select>
                    @error('customers_area')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_county">{{ module_lang('Customers', 'form.county') }}</label>
                    <input class="form-control @error('customers_county') is-invalid @enderror" autocomplete="off" id="customers_county" name="customers_county" value="{{ old('customers_county') }}" />
                    @error('customers_county')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_community">{{ module_lang('Customers', 'form.community') }}</label>
                    <input class="form-control @error('customers_community') is-invalid @enderror" autocomplete="off" id="customers_community" name="customers_community" value="{{ old('customers_community') }}" />
                    @error('customers_community')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_postoffice">{{ module_lang('Customers', 'form.postoffice') }}</label>
                    <input class="form-control @error('customers_postoffice') is-invalid @enderror" autocomplete="off" id="customers_postoffice" name="customers_postoffice" value="{{ old('customers_postoffice') }}" />
                    @error('customers_postoffice')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_country">{{ module_lang('Customers', 'form.country') }}</label>
                    <input class="form-control @error('customers_country') is-invalid @enderror" autocomplete="off" id="customers_country" name="customers_country" value="{{ old('customers_country', 'Polska') }}" />
                    @error('customers_country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 rightline">
            <div class="block-title">{{ module_lang('Customers', 'form.block_details') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="customers_regon">{{ module_lang('Customers', 'form.regon') }}</label>
                    <input class="form-control @error('customers_regon') is-invalid @enderror" autocomplete="off" id="customers_regon" name="customers_regon" value="{{ old('customers_regon') }}" data-inputmask="'mask': '999999999'" maxlength="9" />
                    @error('customers_regon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_nip">{{ module_lang('Customers', 'form.nip') }}</label>
                    <input class="form-control @error('customers_nip') is-invalid @enderror" id="customers_nip" name="customers_nip" value="{{ old('customers_nip') }}" data-inputmask="'mask': '9999999999'" maxlength="10" />
                    @error('customers_nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_krs">{{ module_lang('Customers', 'form.krs') }}</label>
                    <input class="form-control @error('customers_krs') is-invalid @enderror" id="customers_krs" name="customers_krs" value="{{ old('customers_krs') }}" maxlength="14" />
                    @error('customers_krs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_agricultural_land">{{ module_lang('Customers', 'form.agricultural_land') }}</label>
                    <input class="form-control @error('customers_agricultural_land') is-invalid @enderror" id="customers_agricultural_land" name="customers_agricultural_land" value="{{ old('customers_agricultural_land') }}" />
                    @error('customers_agricultural_land')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="customers_trader_id">{{ module_lang('Customers', 'form.trader') }}</label>
                    <select class="form-control @error('customers_trader_id') is-invalid @enderror" autocomplete="off" id="customers_trader_id" name="customers_trader_id">
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        @foreach($traders as $trader)
                            <option value="{{ $trader->id }}" {{ old('customers_trader_id') == $trader->id ? 'selected' : '' }}>{{ $trader->first_name }} {{ $trader->last_name }}</option>
                        @endforeach
                    </select>
                    @error('customers_trader_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ module_lang('Customers', 'form.contact_preference') }}</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="customers_sp_email" id="customers_sp_email" value="1" {{ old('customers_sp_email') ? 'checked' : '' }}>
                        <label class="form-check-label" for="customers_sp_email">{{ module_lang('Customers', 'form.contact_email') }}</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="customers_sp_sms" id="customers_sp_sms" value="1" {{ old('customers_sp_sms') ? 'checked' : '' }}>
                        <label class="form-check-label" for="customers_sp_sms">{{ module_lang('Customers', 'form.contact_sms') }}</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="customers_sp_phone" id="customers_sp_phone" value="1" {{ old('customers_sp_phone') ? 'checked' : '' }}>
                        <label class="form-check-label" for="customers_sp_phone">{{ module_lang('Customers', 'form.contact_phone') }}</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="customers_sp_postoffice" id="customers_sp_postoffice" value="1" {{ old('customers_sp_postoffice') ? 'checked' : '' }}>
                        <label class="form-check-label" for="customers_sp_postoffice">{{ module_lang('Customers', 'form.contact_post') }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfloat"></div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="block-title">{{ module_lang('Customers', 'form.block_details') }}</div>
            <hr />
            <div class="block-content">
                <div class="form-group">
                    <label for="customers_aditional">{{ module_lang('Customers', 'form.annotations') }}</label>
                    <textarea class="form-control @error('customers_aditional') is-invalid @enderror" autocomplete="off" id="customers_aditional" name="customers_aditional" rows="10" cols="150" style="min-height:305px!important">{{ old('customers_aditional') }}</textarea>
                    @error('customers_aditional')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="clearfloat"></div>
        <div class="white-desk">
            <div class="submitbtns">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ module_lang('Customers', 'form.add_customer') }}</button>
                        <button type="reset" class="btn btn-danger">{{ module_lang('Dashboard', 'common.reset') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" id="form_block" name="form_block" style="width:100%;" enctype="multipart/form-data">
    @csrf
    <div class="row nomarginrow">
        <div class="col-sm-12 col-md-4 col-lg-4 rightline">
            <div class="block-title">{{ module_lang('Advertisements', 'form.block_basic') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="adv_machine_type">{{ module_lang('Advertisements', 'form.machine_type') }} <span class="text-danger">*</span></label>
                    <select class="form-control @error('adv_machine_type') is-invalid @enderror" required autocomplete="off" id="adv_machine_type" name="adv_machine_type">
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        @foreach($machines as $machine)
                            <option value="{{ $machine->id }}" {{ old('adv_machine_type') == $machine->id ? 'selected' : '' }}>{{ $machine->name }}</option>
                        @endforeach
                    </select>
                    @error('adv_machine_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_producer">{{ module_lang('Advertisements', 'form.producer') }} <span class="text-danger">*</span></label>
                    <select class="form-control @error('adv_producer') is-invalid @enderror" required autocomplete="off" id="adv_producer" name="adv_producer">
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        @foreach($producers as $producer)
                            <option value="{{ $producer->id }}" {{ old('adv_producer') == $producer->id ? 'selected' : '' }}>{{ $producer->name }}</option>
                        @endforeach
                    </select>
                    @error('adv_producer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_state">{{ module_lang('Advertisements', 'form.state') }}</label>
                    <select class="form-control @error('adv_state') is-invalid @enderror" autocomplete="off" id="adv_state" name="adv_state">
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        @foreach($stans as $stan)
                            <option value="{{ $stan->name }}" {{ old('adv_state') == $stan->name ? 'selected' : '' }}>{{ $stan->name }}</option>
                        @endforeach
                        <option value="Nowe" {{ old('adv_state') == 'Nowe' ? 'selected' : '' }}>{{ module_lang('Advertisements', 'form.state_new') }}</option>
                        <option value="Używane" {{ old('adv_state') == 'Używane' ? 'selected' : '' }}>{{ module_lang('Advertisements', 'form.state_used') }}</option>
                    </select>
                    @error('adv_state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_price">{{ module_lang('Advertisements', 'form.price') }}</label>
                    <input type="text" class="form-control @error('adv_price') is-invalid @enderror" id="adv_price" autocomplete="off" name="adv_price" value="{{ old('adv_price') }}" />
                    @error('adv_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_price_netto">{{ module_lang('Advertisements', 'form.price_netto') }}</label>
                    <input type="text" class="form-control @error('adv_price_netto') is-invalid @enderror" id="adv_price_netto" autocomplete="off" name="adv_price_netto" value="{{ old('adv_price_netto') }}" />
                    @error('adv_price_netto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_order_price">{{ module_lang('Advertisements', 'form.order_price') }}</label>
                    <input type="text" class="form-control @error('adv_order_price') is-invalid @enderror" id="adv_order_price" autocomplete="off" name="adv_order_price" value="{{ old('adv_order_price') }}" />
                    @error('adv_order_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_location">{{ module_lang('Advertisements', 'form.location') }} <span class="text-danger">*</span></label>
                    <select class="form-control @error('adv_location') is-invalid @enderror" autocomplete="off" id="adv_location" name="adv_location" required>
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->name }}" {{ old('adv_location') == $location->name ? 'selected' : '' }}>{{ $location->name }}</option>
                        @endforeach
                    </select>
                    @error('adv_location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_reservation">{{ module_lang('Advertisements', 'form.www_status') }} <span class="text-danger">*</span></label>
                    <select class="form-control @error('adv_reservation') is-invalid @enderror" autocomplete="off" id="adv_reservation" name="adv_reservation" required>
                        <option value="">{{ module_lang('Dashboard', 'common.select') }}</option>
                        <option value="0" {{ old('adv_reservation') == '0' ? 'selected' : '' }}>{{ module_lang('Advertisements', 'form.reservation_displayed') }}</option>
                        <option value="1" {{ old('adv_reservation') == '1' ? 'selected' : '' }}>{{ module_lang('Advertisements', 'form.reservation_reserved') }}</option>
                        <option value="2" {{ old('adv_reservation') == '2' ? 'selected' : '' }}>{{ module_lang('Advertisements', 'form.reservation_soon') }}</option>
                        <option value="4" {{ old('adv_reservation') == '4' ? 'selected' : '' }}>{{ module_lang('Advertisements', 'form.reservation_hidden') }}</option>
                    </select>
                    @error('adv_reservation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="light-bg">
                    <div class="form-group">
                        <label for="fileupload">{{ module_lang('Advertisements', 'form.upload_photos') }}</label>
                        <input type="file" id="fileupload" name="fileupload" class="form-control" accept="image/*,video/*" multiple />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 rightline">
            <div class="block-title">{{ module_lang('Advertisements', 'form.block_details') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="adv_model">{{ module_lang('Advertisements', 'form.model') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('adv_model') is-invalid @enderror" required autocomplete="off" id="adv_model" name="adv_model" value="{{ old('adv_model') }}" />
                    @error('adv_model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_year">{{ module_lang('Advertisements', 'form.year') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('adv_year') is-invalid @enderror" required id="adv_year" autocomplete="off" name="adv_year" value="{{ old('adv_year') }}" data-inputmask="'mask': '9999'" maxlength="4" />
                    @error('adv_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_mileage">{{ module_lang('Advertisements', 'form.mileage') }}</label>
                    <input type="text" class="form-control @error('adv_mileage') is-invalid @enderror" autocomplete="off" id="adv_mileage" name="adv_mileage" value="{{ old('adv_mileage') }}" />
                    @error('adv_mileage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_power">{{ module_lang('Advertisements', 'form.power') }}</label>
                    <input type="text" class="form-control @error('adv_power') is-invalid @enderror" autocomplete="off" id="adv_power" name="adv_power" value="{{ old('adv_power') }}" />
                    @error('adv_power')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_gear">{{ module_lang('Advertisements', 'form.gear') }}</label>
                    <input type="text" class="form-control @error('adv_gear') is-invalid @enderror" id="adv_gear" name="adv_gear" value="{{ old('adv_gear') }}" />
                    @error('adv_gear')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_register">{{ module_lang('Advertisements', 'form.register') }}</label>
                    <input type="text" class="form-control @error('adv_register') is-invalid @enderror" autocomplete="off" id="adv_register" name="adv_register" value="{{ old('adv_register') }}" />
                    @error('adv_register')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_warranty_start">{{ module_lang('Advertisements', 'form.warranty_start') }}</label>
                    <input type="date" class="form-control @error('adv_warranty_start') is-invalid @enderror" autocomplete="off" id="adv_warranty_start" name="adv_warranty_start" value="{{ old('adv_warranty_start') }}" />
                    @error('adv_warranty_start')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_warranty_end">{{ module_lang('Advertisements', 'form.warranty_end') }}</label>
                    <input type="date" class="form-control @error('adv_warranty_end') is-invalid @enderror" autocomplete="off" id="adv_warranty_end" name="adv_warranty_end" value="{{ old('adv_warranty_end') }}" />
                    @error('adv_warranty_end')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 rightline">
            <div class="block-title">{{ module_lang('Advertisements', 'form.block_admin') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="adv_serial_number">{{ module_lang('Advertisements', 'form.serial_number') }}</label>
                    <input type="text" class="form-control @error('adv_serial_number') is-invalid @enderror" autocomplete="off" id="adv_serial_number" name="adv_serial_number" value="{{ old('adv_serial_number') }}" />
                    @error('adv_serial_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_internal_order_number">{{ module_lang('Advertisements', 'form.internal_order_number') }}</label>
                    <input type="text" class="form-control @error('adv_internal_order_number') is-invalid @enderror" autocomplete="off" id="adv_internal_order_number" name="adv_internal_order_number" value="{{ old('adv_internal_order_number') }}" />
                    @error('adv_internal_order_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_producer_order_number">{{ module_lang('Advertisements', 'form.producer_order_number') }}</label>
                    <input type="text" class="form-control @error('adv_producer_order_number') is-invalid @enderror" autocomplete="off" id="adv_producer_order_number" name="adv_producer_order_number" value="{{ old('adv_producer_order_number') }}" />
                    @error('adv_producer_order_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_production_date">{{ module_lang('Advertisements', 'form.production_date') }}</label>
                    <input type="date" class="form-control @error('adv_production_date') is-invalid @enderror" autocomplete="off" id="adv_production_date" name="adv_production_date" value="{{ old('adv_production_date') }}" />
                    @error('adv_production_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="adv_comments">{{ module_lang('Advertisements', 'form.comments') }}</label>
                    <textarea class="form-control @error('adv_comments') is-invalid @enderror" autocomplete="off" id="adv_comments" name="adv_comments" rows="10" cols="150" style="min-height:100px">{{ old('adv_comments') }}</textarea>
                    @error('adv_comments')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="adv_demo" id="adv_demo" value="1" {{ old('adv_demo') ? 'checked' : '' }}>
                        <label class="form-check-label" for="adv_demo">{{ module_lang('Advertisements', 'form.demo') }}</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="adv_promo" id="adv_promo" value="1" {{ old('adv_promo') ? 'checked' : '' }}>
                        <label class="form-check-label" for="adv_promo">{{ module_lang('Advertisements', 'form.promo') }}</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="adv_finances" id="adv_finances" value="1" {{ old('adv_finances') ? 'checked' : '' }}>
                        <label class="form-check-label" for="adv_finances">{{ module_lang('Advertisements', 'form.finances') }}</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="adv_warranty" id="adv_warranty" value="1" {{ old('adv_warranty') ? 'checked' : '' }}>
                        <label class="form-check-label" for="adv_warranty">{{ module_lang('Advertisements', 'form.warranty') }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfloat"></div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <hr />
            <div class="block-title">{{ module_lang('Advertisements', 'form.block_product') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="adv_additional">{{ module_lang('Advertisements', 'form.specification') }}</label>
                    <textarea class="form-control @error('adv_additional') is-invalid @enderror" autocomplete="off" id="adv_additional" name="adv_additional" rows="10" cols="150">{{ old('adv_additional') }}</textarea>
                    @error('adv_additional')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <hr />
            <div class="block-title">{{ module_lang('Advertisements', 'form.block_equipment') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="adv_comments_additional">{{ module_lang('Advertisements', 'form.additional_equipment') }}</label>
                    <textarea class="form-control @error('adv_comments_additional') is-invalid @enderror" autocomplete="off" id="adv_comments_additional" name="adv_comments_additional" rows="10" cols="150" style="min-height:280px">{{ old('adv_comments_additional') }}</textarea>
                    @error('adv_comments_additional')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <hr />
            <div class="block-title">{{ module_lang('Advertisements', 'form.block_info') }}</div>
            <div class="block-content">
                <div class="form-group">
                    <label for="adv_comments_info">{{ module_lang('Advertisements', 'form.additional_info') }}</label>
                    <textarea class="form-control @error('adv_comments_info') is-invalid @enderror" autocomplete="off" id="adv_comments_info" name="adv_comments_info" rows="10" cols="150" style="min-height:280px">{{ old('adv_comments_info') }}</textarea>
                    @error('adv_comments_info')
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
                        <button type="submit" class="btn btn-primary">{{ module_lang('Advertisements', 'form.submit_add') }}</button>
                        <button type="reset" class="btn btn-danger">{{ module_lang('Advertisements', 'form.reset') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

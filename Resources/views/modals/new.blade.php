<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('currency::currencies.add_currency') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="role-form" 
                    action="{{ route('currency.store') }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="currency-name" class="control-label"> {{trans('currency::currencies.form.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="currency-name">
                    </div>
                    <div class="form-group">
                        <label for="currency-code" class="control-label"> {{trans('currency::currencies.form.code') }}</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="currency-code">
                    </div>
                    <div class="form-group">
                        <label for="currency-symbol" class="control-label"> {{trans('currency::currencies.form.symbol') }}</label>
                        <input type="text" name="symbol" value="{{ old('symbol') }}" class="form-control" id="currency-symbol">
                    </div>
                    <div class="form-group">
                        <label for="currency-decimals" class="control-label"> {{trans('currency::currencies.form.decimals') }}</label>
                        <input type="number" name="decimals" value="{{ old('decimals') ? old('decimals') : 2 }}" class="form-control" id="currency-decimals">
                    </div>
                    <div class="form-group">
                        <label for="currency-decimal_point" class="control-label"> {{trans('currency::currencies.form.decimal_point') }}</label>
                        <input type="text" name="decimal_point" value="{{ old('decimal_point') ? old('decimal_point') : '.' }}" class="form-control" id="currency-decimal_point">
                    </div>
                    <div class="form-group">
                        <label for="currency-thousands_sep" class="control-label"> {{trans('currency::currencies.form.thousands_sep') }}</label>
                        <input type="text" name="thousands_sep" value="{{ old('thousands_sep') ? old('thousands_sep') : ',' }}" class="form-control" id="currency-thousands_sep">
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('currency::currencies.modal.cancel') }}</button>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('currency::currencies.modal.save') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
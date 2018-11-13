@extends('layouts.app')

@section('title')
	{{ trans('country::update.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('country::update.title') }}: {{ trans("currencies-list.$currency->slug") }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.config') }}</li>
            </ol>
        </div>
    </div>
          
    <!-- Countries table -->
    <div class="row">
        <div class="col-12">
            @if($errors->any())
              <div class="alert alert-danger">
                  <ul class="no-margin" style="margin: 0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              <br>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('country::update.title') }}: <strong>{{ trans("currencies-list.$currency->slug") }}</strong></h4>
                    <form id="languaje-form" 
                    action="{{ route('currency.update', ['id' => $currency->id]) }}"
                    method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="currency-name" class="control-label"> {{trans('currency::currencies.form.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') ? old('name') : trans("currencies-list.$currency->slug") }}" class="form-control" id="currency-name">
                    </div>
                    <div class="form-group">
                        <label for="currency-code" class="control-label"> {{trans('currency::currencies.form.code') }}</label>
                        <input type="text" name="code" value="{{ old('code') ? old('code') : $currency->code }}" class="form-control" id="currency-code">
                    </div>
                    <div class="form-group">
                        <label for="currency-symbol" class="control-label"> {{trans('currency::currencies.form.symbol') }}</label>
                        <input type="text" name="symbol" value="{{ old('symbol') ? old('symbol') : $currency->symbol }}" class="form-control" id="currency-symbol">
                    </div>
                    <div class="form-group">
                        <label for="currency-decimals" class="control-label"> {{trans('currency::currencies.form.decimals') }}</label>
                        <input type="number" name="decimals" value="{{ old('decimals') ? old('decimals') : $currency->decimals }}" class="form-control" id="currency-decimals">
                    </div>
                    <div class="form-group">
                        <label for="currency-decimal_point" class="control-label"> {{trans('currency::currencies.form.decimal_point') }}</label>
                        <input type="text" name="decimal_point" value="{{ old('decimal_point') ? old('decimal_point') : $currency->decimal_point }}" class="form-control" id="currency-decimal_point">
                    </div>
                    <div class="form-group">
                        <label for="currency-thousands_sep" class="control-label"> {{trans('currency::currencies.form.thousands_sep') }}</label>
                        <input type="text" name="thousands_sep" value="{{ old('thousands_sep') ? old('thousands_sep') : $currency->thousands_sep }}" class="form-control" id="currency-thousands_sep">
                    </div>

                    <a href="{{ route('languajes.index') }}" type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('languajes.form.cancel') }}</a>
                    <button onclick="event.preventDefault(); document.getElementById('languaje-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('languajes.form.submit') }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop

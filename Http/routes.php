<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'admin/settings/currencies', 'namespace' => 'Modules\Currency\Http\Controllers'], function() {
	//
    Route::get('/', 'CurrencyController@index')->name('currency.index');
    Route::post('/store', 'CurrencyController@store')->name('currency.store');
    Route::get('/update/{id}', 'CurrencyController@edit')->name('currency.modify');
    Route::put('/update/{id}', 'CurrencyController@update')->name('currency.update');
    Route::delete('/destroy/{id}', 'CurrencyController@destroy')->name('currency.destroy');
});

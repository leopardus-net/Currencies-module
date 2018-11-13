<?php

namespace Modules\Currency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
//
use Modules\Currency\Entities\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $currencies = Currency::paginate();

        return view('currency::index', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // slug
        $slug = str_slug($request->name, '-');

        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                "unique:currencies,slug,$slug"
            ],
            'code' => 'required|string|max:11|unique:currencies,code',
            'decimals' => 'required|integer|max:11',
            'decimal_point' => 'required',
            'thousands_sep' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }

        // Creamos el país.
        $currency = Currency::create([
            'slug' => $slug,
            'code' => $request->code,
            'symbol' => $request->symbol,
            'decimals' => $request->decimals,
            'decimal_point' => $request->decimal_point,
            'thousands_sep' => $request->thousands_sep
        ]);

        // Creamos una nueva traducción
        $translation = translations('currencies-list');

        $translation->add($slug, $request->name);

        $translation->publish();

        return redirect('admin/settings/currencies')
                ->with('action', 'create');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    { 
        $currency = Currency::findOrFail($id);

        return view('currency::update', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Obtenemos el país
        $currency = Currency::findOrFail($id);

        // Validaciones
        $validator = \Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                "unique:currencies,slug,$currency->id"
            ],
            'code' => "required|string|unique:currencies,code,$currency->id|max:11",
            'decimals' => 'required|integer|max:11',
            'decimal_point' => 'required',
            'thousands_sep' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $currency->decimals = $request->decimals;
        $currency->decimal_point = $request->decimal_point;
        $currency->thousands_sep = $request->thousands_sep;
        $currency->code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->save();

        // Creamos una nueva traducción
        $translation = translations('currencies-list');

        $translation->add($currency->slug, $request->name);

        $translation->publish();

        return redirect('admin/settings/currencies')
                ->with('action', 'update');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
            
        $currency->delete();   
     
        return redirect('/admin/settings/currencies')
                ->with('action', 'destroy');
    }
}

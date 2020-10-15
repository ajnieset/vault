<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use App\Http\Resources\Vault as VaultResource;
use Brick\Math\RoundingMode;
use Brick\Money\CurrencyConverter;
use Brick\Money\ExchangeRateProvider\ConfigurableProvider;
use Brick\Money\Money;
use Illuminate\Http\Request;

class VaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VaultResource::collection(Vault::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function show(Vault $vault)
    {
        return new VaultResource($vault);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vault $vault)
    {
        $amount = Money::of($request->amount, $request->currency);

        //setup exchange rate provider
        //TODO: change to db table
        $provider = new ConfigurableProvider();
        $provider->setExchangeRate('EUR', 'USD', '1.18');
        $provider->setExchangeRate('EUR', 'GBP', '0.9');

        $converter = new CurrencyConverter($provider);

        if ($request->currency !== $vault->currencyCode) {
            $amount = $converter->convert($amount, $vault->currencyCode, RoundingMode::DOWN);
        }

        if ($request->type === 'cash') {
            $vault->cashValue = Money::of($vault->cashValue, $vault->currencyCode)->plus($amount)->getAmount();
        } if ($request->type === 'digital') {
            $vault->digitalValue = Money::of($vault->digitalValue, $vault->currencyCode)->plus($amount)->getAmount();
        }

        $vault->totalValue = $amount->plus($vault->totalValue)->getAmount();
        $vault->save();

        return new VaultResource($vault);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vault  $vault
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vault $vault)
    {
        //
    }
}

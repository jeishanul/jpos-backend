<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = CurrencyRepository::getAll();
        return $this->json('Currency List', [
            'currencies' => CurrencyResource::collection($currencies),
        ]);
    }
    public function store(CurrencyRequest $currencyRequest)
    {
        $currency = CurrencyRepository::storeByRequest($currencyRequest);
        return $this->json('Currency successfully created', [
            'currency' => CurrencyResource::make($currency),
        ]);
    }
    public function details(Currency $currency)
    {
        return $this->json('Currency Details', [
            'currency' => CurrencyResource::make($currency),
        ]);
    }
    public function update(CurrencyRequest $currencyRequest, Currency $currency)
    {
        $currency = CurrencyRepository::updateByRequest($currencyRequest, $currency);
        return $this->json('Currency successfully updated', [
            'currency' => CurrencyResource::make($currency),
        ]);
    }
    public function delete(Currency $currency)
    {
        $currency->delete();
        return $this->json('Currency successfully deleted');
    }
}

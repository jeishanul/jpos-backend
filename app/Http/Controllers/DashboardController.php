<?php

namespace App\Http\Controllers;

use App\Repositories\PurchaseRepository;
use App\Repositories\SaleRepository;

class DashboardController extends Controller
{
    public function index()
    {
        $purchages = PurchaseRepository::getAll();
        $sales = SaleRepository::getAll();

        return $this->json('Dashboard data', [
            'purchages' => $purchages->sum('grand_total'),
            'sale' => $sales->sum('grand_total'),
            'purchage_due' =>  $purchages->sum('grand_total') - $purchages->sum('paid_amount'),
            'sale_due' =>  $sales->sum('grand_total') - $sales->sum('paid_amount')
        ]);
    }
}

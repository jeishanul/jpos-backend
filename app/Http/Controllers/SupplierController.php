<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\User;
use App\Repositories\AddressRepository;
use App\Repositories\CompanyInfoRepository;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = SupplierRepository::query()->where('role', Role::SUPPLIER->value)->get();
        return $this->json('Supplier List', [
            'suppliers' => SupplierResource::collection($suppliers),
        ]);
    }
    public function store(SupplierRequest $supplierRequest)
    {
        $supplier = SupplierRepository::storeByRequest($supplierRequest);
        AddressRepository::storeByRequest($supplierRequest, $supplier);
        CompanyInfoRepository::storeByRequest($supplierRequest, $supplier);
        return $this->json('Supplier successfully created', [
            'supplier' => SupplierResource::make($supplier),
        ]);
    }
    public function details(User $supplier)
    {
        return $this->json('Supplier Details', [
            'supplier' => SupplierResource::make($supplier),
        ]);
    }
    public function update(SupplierRequest $supplierRequest, User $supplier)
    {
        $supplier = SupplierRepository::updateByRequest($supplierRequest, $supplier);
        AddressRepository::updateByRequest($supplierRequest, $supplier);
        CompanyInfoRepository::updateByRequest($supplierRequest, $supplier);
        return $this->json('Supplier successfully updated', [
            'supplier' => SupplierResource::make($supplier),
        ]);
    }
    public function delete(User $supplier)
    {
        $supplier->delete();
        return $this->json('Supplier successfully deleted');
    }
}

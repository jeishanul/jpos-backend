<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\User;
use App\Repositories\AddressRepository;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = CustomerRepository::query()->where('role', Role::CUSTOMER->value)->get();
        return $this->json('Customer List', [
            'customers' => CustomerResource::collection($customers),
        ]);
    }
    public function store(CustomerRequest $customerRequest)
    {
        $customer = CustomerRepository::storeByRequest($customerRequest);
        AddressRepository::storeByRequest($customerRequest, $customer);
        return $this->json('Customer successfully created', [
            'customer' => CustomerResource::make($customer),
        ]);
    }
    public function details(User $customer)
    {
        return $this->json('Customer Details', [
            'customer' => CustomerResource::make($customer),
        ]);
    }
    public function update(CustomerRequest $customerRequest, User $customer)
    {
        $customer = CustomerRepository::updateByRequest($customerRequest, $customer);
        AddressRepository::updateByRequest($customerRequest, $customer);
        return $this->json('Customer successfully updated', [
            'customer' => CustomerResource::make($customer),
        ]);
    }
    public function delete(User $customer)
    {
        $customer->delete();
        return $this->json('Customer successfully deleted');
    }
}

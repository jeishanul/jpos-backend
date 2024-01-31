<?php

namespace App\Http\Controllers;

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
        $request = request();
        $search = $request->search;
        $page = $request->page;
        $take = $request->take;
        $skip = ($page * $take) - $take;

        $searchCustomers = CustomerRepository::search($search);
        $total = $searchCustomers->count();
        $customers = $searchCustomers->when($page && $take, function ($query) use ($skip, $take) {
            $query->skip($skip)->take($take);
        })->get();

        return $this->json('Customer List', [
            'total' => $total,
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
    public function destroy(User $customer)
    {
        $customer->delete();
        return $this->json('Customer successfully deleted');
    }
}

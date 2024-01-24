<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
    }
    public function store(CustomerRequest $customerRequest)
    {
    }
    public function details(User $customer)
    {
    }
    public function update(CustomerRequest $customerRequest, User $customer)
    {
    }
    public function delete(User $customer)
    {
    }
}

<?php

namespace App\Repositories;

use App\Models\Tax;

class TaxRepository extends Repository
{
    public function model()
    {
        return Tax::class;
    }
}

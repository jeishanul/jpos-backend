<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository extends Repository
{
    public function model()
    {
        return Brand::class;
    }
}

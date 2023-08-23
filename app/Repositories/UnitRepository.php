<?php

namespace App\Repositories;

use App\Models\Unit;

class UnitRepository extends Repository
{
    public function model()
    {
        return Unit::class;
    }
}

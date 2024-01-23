<?php

namespace App\Repositories;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;

class UnitRepository extends Repository
{
    public static function model()
    {
        return Unit::class;
    }
    public static function storeByRequest(UnitRequest $unitRequest): Unit
    {
        return self::create([
            'created_by' => auth()->id(),
            'shop_id' => self::shop()->id,
            'code' => $unitRequest->code,
            'name' => $unitRequest->name,
            'status' => $unitRequest->status
        ]);
    }

    public static function updateByRequest(UnitRequest $unitRequest, Unit $unit): Unit
    {
        self::update($unit, [
            'code' => $unitRequest->code,
            'name' => $unitRequest->name,
            'status' => $unitRequest->status
        ]);

        return $unit;
    }
}

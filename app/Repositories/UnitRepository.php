<?php

namespace App\Repositories;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;

class UnitRepository extends Repository
{
    /**
     * A description of the entire PHP function.
     *
     * @return Unit::class
     */
    public static function model()
    {
        return Unit::class;
    }
    /**
     * Store a new unit based on the provided request.
     *
     * @param UnitRequest $unitRequest The unit request data
     * @return Unit The newly created unit
     */
    public static function storeByRequest(UnitRequest $unitRequest): Unit
    {
        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'code' => $unitRequest->code,
            'name' => $unitRequest->name,
            'status' => $unitRequest->status
        ]);
    }
    /**
     * Update a unit using the provided unit request and unit object.
     *
     * @param UnitRequest $unitRequest The unit request object
     * @param Unit $unit The unit object to be updated
     * @return Unit The updated unit object
     */
    public static function updateByRequest(UnitRequest $unitRequest, Unit $unit): Unit
    {
        self::update($unit, [
            'code' => $unitRequest->code,
            'name' => $unitRequest->name,
            'status' => $unitRequest->status
        ]);

        return $unit;
    }
    /**
     * Search for units based on the given search criteria.
     *
     * @param mixed $search The search criteria to filter units.
     * @return mixed The units matching the search criteria.
     */
    public static function search($search)
    {
        $units = self::shop()->units()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%")
                ->orWhere('code', 'Like', "%{$search}%");
        });

        return $units;
    }
}

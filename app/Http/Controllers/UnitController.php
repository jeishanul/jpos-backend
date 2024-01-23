<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use App\Repositories\UnitRepository;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = UnitRepository::getAll();
        return $this->json('Unit List', [
            'units' => UnitResource::collection($units),
        ]);
    }
    public function store(UnitRequest $unitRequest)
    {
        $unit = UnitRepository::storeByRequest($unitRequest);
        return $this->json('Unit successfully created', [
            'unit' => UnitResource::make($unit),
        ]);
    }
    public function details(Unit $unit)
    {
        return $this->json('Unit Details', [
            'unit' => UnitResource::make($unit),
        ]);
    }
    public function update(UnitRequest $unitRequest, Unit $unit)
    {
        $$unit = UnitRepository::updateByRequest($unitRequest, $unit);
        return $this->json('Brand successfully updated', [
            'unit' => UnitResource::make($unit),
        ]);
    }
    public function delete(Unit $unit)
    {
        $unit->delete();
        return $this->json('Unit successfully deleted');
    }
}

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
        $request = request();
        $search = $request->search;
        $page = $request->page;
        $take = $request->take;
        $skip = ($page * $take) - $take;

        $searchUnits = UnitRepository::search($search);
        $total = $searchUnits->count();
        $units = $searchUnits->when($page && $take, function ($query) use ($skip, $take) {
            $query->skip($skip)->take($take);
        })->get();

        return $this->json('Unit List', [
            'total' => $total,
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
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return $this->json('Unit successfully deleted');
    }
}

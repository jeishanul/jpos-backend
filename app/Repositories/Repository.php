<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    abstract public static function model();
    /**
     * Query the model to start building a new query.
     *
     * @return Builder
     */
    public static function query(): Builder
    {
        return static::model()::query();
    }
    /**
     * Get all the items from the collection.
     *
     * @return Collection
     */
    public static function getAll(): Collection
    {
        return static::model()::latest()->get();
    }
    /**
     * @return Builder|Model|object|null
     */
    public static function first(): Model|null
    {
        return static::query()->first();
    }
    /**
     * @return Builder|Builder[]|Collection|Model|null|mixed
     */
    public static function find($primaryKey): Model|null
    {
        return static::query()->find($primaryKey);
    }
    /**
     * @return Builder|Builder[]|Collection|Model|null|mixed
     */
    public static function findOrFail($primaryKey)
    {
        return static::query()->findOrFail($primaryKey);
    }
    /**
     * Delete a record by primary key.
     *
     * @param datatype $primaryKey description
     * @return bool
     */
    public static function delete($primaryKey): bool
    {
        return static::model()::destroy($primaryKey);
    }
    /**
     * @return Builder|Model|mixed
     */
    public static function create(array $data): Model
    {
        return static::query()->create($data);
    }
    /**
     * @return bool
     */
    public static function update(Model $model, array $data): bool
    {
        return $model->update($data);
    }
    /**
     * A description of the entire PHP function.
     *
     * @return mixed
     */
    protected static function shop()
    {
        $user = auth()->user();
        $shop = $user->shopUser->first();

        return match ($shop) {
            null => $user->shop,
            default => $shop
        };
    }
}

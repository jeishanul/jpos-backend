<?php

namespace App\Models;

use App\Enums\Role;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'status' => Status::class,
    ];
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }
    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }
    public function customers()
    {
        return $this->hasMany(User::class)->where('role', Role::CUSTOMER->value);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function suppliers()
    {
        return $this->hasMany(User::class)->where('role', Role::SUPPLIER->value);
    }
    public function taxs()
    {
        return $this->hasMany(Tax::class);
    }
    public function shopUser()
    {
        return $this->belongsToMany(User::class, 'shop_users');
    }
}
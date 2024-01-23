<?php

namespace App\Models;

use App\Enums\BarcodeSymbology;
use App\Enums\ProductType;
use App\Enums\Status;
use App\Enums\TaxMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'status' => Status::class,
        'type' => ProductType::class,
        'barcode_symbology' => BarcodeSymbology::class,
        'tax_method' => TaxMethods::class,
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}

<?php

namespace App\Models;

use App\Enums\DiscountType;
use App\Enums\Status;
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
        'discount_type' => DiscountType::class,
    ];

    public function media()
    {
    	return $this->belongsTo(Media::class,'media_id');
    }
}

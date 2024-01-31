<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'payment_status' => PaymentStatus::class,
        'payment_method' => PaymentMethod::class,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    public function saleProducts()
    {
        return $this->hasMany(SaleProduct::class);
    }
}

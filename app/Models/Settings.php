<?php

namespace App\Models;

use App\Enums\CurrencyPosition;
use App\Enums\DateFormat;
use App\Enums\DateSeparator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'currency_position' => CurrencyPosition::class,
        'date_format' => DateFormat::class,
        'date_separator' => DateSeparator::class,
    ];
    public function logo()
    {
        return $this->belongsTo(Media::class, 'logo');
    }
    public function smallLogo()
    {
        return $this->belongsTo(Media::class, 'small_logo');
    }
    public function favicon()
    {
        return $this->belongsTo(Media::class, 'favicon');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}

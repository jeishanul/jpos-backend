<?php

namespace App\Models;

use App\Enums\FileTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'type' => FileTypes::class,
    ];

    public function file(): Attribute
    {
        $defualt = Storage::exists($this->src) ? Storage::url($this->src) : asset('defualt/defualt.jpg');
        return Attribute::make(
            get: fn () => $defualt,
        );
    }
}

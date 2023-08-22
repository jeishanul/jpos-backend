<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'status' => Status::class,
    ];

    public function media()
    {
    	return $this->belongsTo(Media::class,'media_id');
    }

    public function parentCategory()
    {
    	return $this->belongsTo(Category::class,'parent_id');
    }
}

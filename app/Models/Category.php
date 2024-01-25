<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}

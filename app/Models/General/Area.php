<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\General\Category;
use App\Models\General\Reference;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'difficulty',
        'creation_time',
        'path_image_square',
    ];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function references(){
        return $this->morphMany(Reference::class, 'referenceable');
    }
}

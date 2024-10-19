<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\General\Category;

class Character extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'start_age',
        'path_front_square',
        'path_side_square',
        'path_front_partial',
        'path_side_partial',
        'path_front_full',
        'path_side_full',
    ];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}

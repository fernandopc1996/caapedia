<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\General\Reference;

class Author extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
    ];

    public function references(){
        return $this->morphMany(Reference::class, 'referenceable');
    }
}

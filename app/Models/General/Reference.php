<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'reference',
        'link',
    ];

    public function referenceable(){
        return $this->morphTo();
    }
}

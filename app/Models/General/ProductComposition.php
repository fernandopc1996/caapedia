<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\General\Product;
use App\Models\General\Fauna;
use App\Models\General\Flora;
use App\Models\General\Area;

class ProductComposition extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'quantity', 

        'composition_product_id',
        'composition_fauna_id',
        'composition_flora_id',
        'composition_quantity',
        'composition_water',
        'composition_money', 
        'required_area_id',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function compositionProduct(){
        return $this->hasOne(Product::class, 'id', 'composition_product_id');
    }

    public function compositionFauna(){
        return $this->hasOne(Fauna::class, 'id', 'composition_fauna_id');
    }

    public function compositionFlora(){
        return $this->hasOne(Flora::class, 'id', 'composition_flora_id');
    }

    public function compositionArea(){
        return $this->hasOne(Area::class, 'id', 'required_area_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "product";
    protected $primary_key = "id";
    use HasFactory;

    public function category(){
        return $this->hasManyThrough(Category::class,SubCategory::class,"subcategory_id","category_id","subcategory_id","category_id");
    }

    public function subcategory(){
        return $this->hasMany(SubCategory::class,'subcategory_id','subcategory_id')->select('subcategory_id','subcategory_name')->where('status',1);
    }
}

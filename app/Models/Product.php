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
        return $this->hasManyThrough(Category::class,SubCategory::class,"subcategory_id","category_id","subcategory_id","category_id")->select('category.category_id','category_name')->where('category.status',1)->where('subcategory.status',1);
    }

    public function subcategory(){
        return $this->hasMany(SubCategory::class,'subcategory_id','subcategory_id')->select('subcategory_id','subcategory_name')->where('status',1);
    }
}

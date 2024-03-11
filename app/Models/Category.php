<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = "category";
    public $primary_key = "category_id";
    use HasFactory;

    public function product(){
        return $this->hasMany(Product::class,"category_id","category_id")->where('status',1);
    }
}

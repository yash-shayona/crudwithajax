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
        return $this->hasMany(Category::class,"category_id","category_id")->where('status',1);
    }
}

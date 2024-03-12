<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\select;

class SubCategory extends Model
{
    public $table = "subcategory";
    protected $primary_key='subcategory_id';
    use HasFactory;

    public function category(){
        return $this->hasMany(Category::class,'category_id','category_id')->select('category_id','category_name')->where('status',1);
    }
}

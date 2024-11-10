<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
//    protected $guarded = [];
    protected $fillable = ['user_id','parent_category_id','name','type','description'];
}

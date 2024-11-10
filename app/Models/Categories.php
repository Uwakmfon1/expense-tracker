<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['user_id','parent_category_id','name','type','img_url','description'];

}

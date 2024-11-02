<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Budget extends Model
{
    protected $fillable = ['category_id','name','amount','description','start_date','end_date'];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date_column)->translatedFormat('jS F, Y');
    }
}

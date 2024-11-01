<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['category_id', 'name', 'type', 'amount', 'received_at', 'description'];

    const TYPES = ['one time','daily','weekly','monthly','yearly'];


}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    public $timestamps = false;
    protected $fillable = ['category', 'field', 'value'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Not relevant to the series...
    public static $rules = [];

    protected $fillable = ['name', 'description'];
}

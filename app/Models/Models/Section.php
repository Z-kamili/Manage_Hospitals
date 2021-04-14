<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $fillable = ['name'];
    public $timestamps = false;
    use HasFactory;
}

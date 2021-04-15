<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class SectionTranslation extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    use HasFactory;
}

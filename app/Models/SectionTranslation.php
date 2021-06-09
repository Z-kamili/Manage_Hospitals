<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class SectionTranslation extends Model
{
    protected $fillable = ['name','description'];
    public $timestamps = false;
    use HasFactory;
}

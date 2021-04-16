<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name','appointment'];
    public $fillables = ['email','email_verified_at','password','phone','price','name','appointment'];


    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}

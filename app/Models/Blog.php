<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Blog extends Model
{ 
    protected $with = ['blog_translations'];

    public function getTranslation($field = '', $lang = false)
    {
      $lang = $lang == false ? App::getLocale() : $lang;
      $blog_translation = $this->blog_translations->where('lang', $lang)->first();
      return $blog_translation != null ? $blog_translation->$field : $this->$field;
    }

    public function blog_translations()
    {
        return $this->hasMany(BlogTranslation::class);
    }
  

    public function category() {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

}

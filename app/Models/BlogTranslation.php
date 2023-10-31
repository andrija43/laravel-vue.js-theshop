<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    protected $fillable = ['title', 'short_description', 'description', 'lang', 'blog_id'];

    public function blog(){
        return $this->belongsTo(Blog::class);
    }
}

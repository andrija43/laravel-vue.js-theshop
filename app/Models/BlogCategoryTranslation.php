<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoryTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'lang', 'blog_category_id'];

    public function blog_category(){
        return $this->belongsTo(BlogCategory::class);
    }
}

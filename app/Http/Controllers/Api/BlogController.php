<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\BlogCollection;
use App\Http\Resources\BlogSingleCollection;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    { 
        $category = $request->category_slug ? BlogCategory::where('slug', $request->category_slug)->first() : null;
        $search_keyword             = $request->searchKeyword;
        $category_id                = optional($category)->id;

        $blogs = Blog::latest()->where('status',1);
          // search keyword check
        if ($search_keyword != null) {
            $blogs->where(function ($q) use ($search_keyword) {
                foreach (explode(' ', trim($search_keyword)) as $word) {
                    $q->where('title', 'like', '%' . $word . '%');
                }
            }); 
        }

        // category check
        if ($category_id != null) {
            $blogs->where('category_id',$category_id);
        }
 
        $collection = new BlogCollection($blogs->paginate(12));

        return response()->json([
            'success' => true,
            'metaTitle' => $category ? $category->meta_title : get_setting('meta_title'),
            'blogs' => $collection,
            'totalPage' => $collection->lastPage(),
            'currentPage' => $collection->currentPage(),
            'total' => $collection->total(),
            'currentCategory' => $category
        ]);
    }

    public function indexCategory()
    {
        return [
                'success' => true,
                'data' => BlogCategory::latest()->get(),
                'recentBlogs' => new BlogCollection(Blog::latest()->where('status',1)->take(5)->get()),
            ]; 
    }

    public function show($blog_slug)
    {
        $blog = Blog::where('slug', $blog_slug)->where('status',1)->first();
        if ($blog) {
            return [
                'success' => true,
                'data' => new BlogSingleCollection($blog),
                'recentBlogs' => new BlogCollection(Blog::latest()->where('status',1)->take(5)->get()),
            ];
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => translate('Blog not found')
            ]);
        }
    }
}

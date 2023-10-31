<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogCategoryTranslation;

class BlogCategoryController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:view_blog_categories'])->only('index');
        $this->middleware(['permission:add_blog_category'])->only('create');
        $this->middleware(['permission:edit_blog_category'])->only('edit');
        $this->middleware(['permission:delete_blog_category'])->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $categories = BlogCategory::orderBy('name', 'asc');

        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');
        }
        
        $categories = $categories->paginate(15);
        return view('backend.blog.category.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|max:255',
        ]);
        
        $blog_category = new BlogCategory;
        
        $blog_category->name = $request->name;
        $blog_category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name));
        
        $blog_category->save();

        $blog_category_translation = BlogCategoryTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'blog_category_id' => $blog_category->id]);
        $blog_category_translation->name = $request->name;
        $blog_category_translation->save();
        
        flash(translate('Blog category has been created successfully'))->success();
        return redirect()->route('blog-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang   = $request->lang;
        $cateogry = BlogCategory::find($id);
        $all_categories = BlogCategory::all();
        
        return view('backend.blog.category.edit',  compact('cateogry','all_categories','lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $blog_category = BlogCategory::find($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $blog_category->name = $request->name;
        }
        $blog_category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name));
        $blog_category->save();
        
        $blog_category_translation = BlogCategoryTranslation::firstOrNew(['lang' => $request->lang, 'blog_category_id' => $blog_category->id]);
        $blog_category_translation->name = $request->name;
        $blog_category_translation->save();
        
        flash(translate('Blog category has been updated successfully'))->success();
        return redirect()->route('blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        $blog_category->blog_category_translations()->delete();
        $blog_category->blogs()->delete();

        BlogCategory::destroy($id);

        flash(translate('Blog Category has been deleted successfully'))->success();
        return redirect('admin/blog-category');
    }
}

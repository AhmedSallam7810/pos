<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
    
        $categories=Category::when($request->search,function ($query)use ($request){
            return $query->whereTranslationLike('name','%'.$request->search.'%');
        })->latest()->paginate(5);

        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
       // dd($request->all());

        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each

        $request->validate($rules);



         Category::create($request->all());

        return redirect()->route('dashboard.categories.index')
        ->with('success',__('site.added_successfully'));
    }

    
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];

        }//end of for each

        $request->validate($rules);
        

        $category->update($request->all());

        return redirect()->route('dashboard.categories.index')
        ->with('success',__('site.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('dashboard.categories.index')
        ->with('success',__('site.deleted_successfully'));

    }
}

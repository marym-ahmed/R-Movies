<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $categories = category::get();
        return view('categories.index', compact('categories'));
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {

        return view('Categories.create');
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
            'category' => 'required'

        ]);

        category::create($request->post());

        return redirect()->route('categories.index')->with('success','category has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\category  $category
    * @return \Illuminate\Http\Response
    */
    public function show($category)
    {
        $categorys = category::find($category);
        return view('categories.show', [
            'categorys' => $categorys,
        ]);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\category  $category
    * @return \Illuminate\Http\Response
    */






    public function edit(category $category)
    {
        return view('Categories.edit',compact('category'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\category  $category
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, category $category)
    {
        $request->validate([
            'category' => 'required'

        ]);

        $category->fill($request->post())->save();

        return redirect()->route('categories.index')->with('success','category Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\category  $category
    * @return \Illuminate\Http\Response
    */
    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success','category has been deleted successfully');
    }

    public function search(Request $request){
        $search = $request->input('search');
        $categories = category::query()->where('category', 'LIKE', "%{$search}%")->get();
        return view('categories.search', compact('categories'));
    }


    
    
}



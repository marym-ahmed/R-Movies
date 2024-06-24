<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request) // استخدام CategoryRequest هنا
    {
        $this->categoryRepo->create($request->validated());

        return redirect()->route('categories.index')->with('success', 'Category has been created successfully.');
    }

    public function show($id)
    {
        $category = $this->categoryRepo->find($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = $this->categoryRepo->find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id) // استخدام CategoryRequest هنا
    {
        $category = $this->categoryRepo->find($id);
        $this->categoryRepo->update($category, $request->validated());

        return redirect()->route('categories.index')->with('success', 'Category has been updated successfully.');
    }

    public function destroy($id)
    {
        $category = $this->categoryRepo->find($id);
        $this->categoryRepo->delete($category);

        return redirect()->route('categories.index')->with('success', 'Category has been deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $categories = $this->categoryRepo->search($search);
        return view('categories.search', compact('categories'));
    }
}

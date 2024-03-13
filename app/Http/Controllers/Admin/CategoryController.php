<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InsertUpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends AdminController
{
    public function __construct(private readonly Category $categoryModel = new Category())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categoryModel = new Category();
            $categories = $categoryModel->getAll();
            return view('pages.admin.categories.index')->with('categories', $categories)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
           $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.categories.create')->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsertUpdateCategoryRequest $request)
    {
        try {
            $this->categoryModel->insert($request->input('categoryName'), $request->file('icon'));
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
        }
        catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.categories.index')->with('error', 'Category creation failed.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = $this->categoryModel::find($id);
            return view('pages.admin.categories.edit')->with('category', $category)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.categories.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsertUpdateCategoryRequest $request, string $id)
    {
        try {
            $this->categoryModel->updateCategory($request->input('categoryName'),$request->file('icon'), $id);
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
        }catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.categories.index')->with('error', 'Category update failed.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = $this->categoryModel::find($id);
            if($category->jobs->count() > 0)
                return redirect()->route('admin.categories.index')->with('error', 'Category cannot be deleted as it has jobs associated with it.');
            $this->categoryModel->deleteCategory($id);
            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
        }catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.categories.index')->with('error', 'Category deletion failed.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InsertUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CategoryController extends AdminController
{
    public function __construct(private readonly Category $categoryModel = new Category())
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View|RedirectResponse
    {
        try {
            $data = [
                'title' => 'Categories',
                'entityName' => 'Category',
                'route' => 'admin.categories',
                'columns' => Schema::getColumnListing('categories'),
                'values' => Category::all()
            ];
            return view('pages.admin.index')->with('active', $this->currentRoute)
                ->with('data', $data);
        } catch (\Exception $e) {
           $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $data = [
            'entityName' => 'Category',
            'resourceName' => 'categories',
            'columns' => Schema::getColumnListing('categories'),
        ];
        return view('pages.admin.create')->with('data', $data)->with('active', $this->currentRoute);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InsertUpdateCategoryRequest $request) : RedirectResponse
    {
        try {
            $this->categoryModel->insert($request->input('name'), $request->file('icon'));
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
    public function edit(string $id) : View|RedirectResponse
    {
        try {
            $data = [
            'entityName' => 'Category',
            'resourceName' => 'categories',
            'columns' => Schema::getColumnListing('categories'),
            'entity' => $this->categoryModel::find($id)
            ];
            return view('pages.admin.edit')->with('data', $data)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.categories.index')->with('error', 'An error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsertUpdateCategoryRequest $request, string $id) : RedirectResponse
    {
        try {
            $this->categoryModel->updateCategory($request->input('name'),$request->file('icon'), $id);
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
        }catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.categories.index')->with('error', 'Category update failed.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
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

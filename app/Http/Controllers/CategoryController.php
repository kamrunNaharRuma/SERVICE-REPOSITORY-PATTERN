<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Responses\ApiException;
use App\Http\Responses\ApiResponse;
use App\Models\Category;
use App\Services\CategoryServiceInterface;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryServiceInterface $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        try {
            $category = $this->category->all();
            return (new ApiResponse('Category List', $category, Response::HTTP_OK, true))->getPayload();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
    }

    public function store(CategoryCreateRequest $request)
    {
        try {
            $category = $this->category->store($request->all());
            return (new ApiResponse('Category stored successfully', $category, Response::HTTP_CREATED, true))->getPayload();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
    }

    public function update(Request $request, Category $category)
    {
        if (!Gate::allows('store-update-delete-category', Auth::user())) {
            abort(403); //Only admin user can create category
        }
        try {
            $category = $this->category->update($request->all(), $category);
            return (new ApiResponse('Category updated successfully', $category, Response::HTTP_OK, true))->getPayload();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        if (!Gate::allows('store-update-delete-category', Auth::user())) {
            abort(403); //Only admin user can create category
        }
        try {
            $category = $this->category->delete($category->id);
            return (new ApiResponse('Category deleted successfully', $category, Response::HTTP_OK, true))->getPayload();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
    }
}

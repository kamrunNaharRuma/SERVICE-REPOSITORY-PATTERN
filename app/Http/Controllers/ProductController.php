<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiException;
use App\Http\Responses\ApiResponse;
use App\Services\ProductCategoryServiceInterface;
use App\Services\ProductColorServiceInterface;
use App\Services\ProductServiceInterface;
use App\Services\ProductSizeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $product;
    private $productSize;
    private $productColor;
    private $productCategory;
    public function __construct(
        ProductServiceInterface $product,
        ProductSizeServiceInterface $productSize,
        ProductColorServiceInterface $productColor,
        ProductCategoryServiceInterface $productCategory
    ) {
        $this->product = $product;
        $this->productSize = $productSize;
        $this->productColor = $productColor;
        $this->productCategory = $productCategory;
    }
    public function index()
    {
        //
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
        if (!Gate::allows('store-update-delete-product', Auth::user())) {
            abort(403);
        }
        $validatedData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required|integer',
            'color_id' => 'array',
            'size_id' => 'array',
            'category_id' => 'required|array',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['slug'], '-');

        DB::beginTransaction();
        try {
            $product = $this->product->store($validatedData);
            $this->productSize->store($validatedData['size_id'], $product->id);
            $this->productColor->store($validatedData['color_id'], $product->id);
            $this->productCategory->store($validatedData['category_id'], $product->id);
            DB::commit();
            return (new ApiResponse('product stored successfully', $product, Response::HTTP_CREATED, true))->getPayload();
        } catch (\Exception $e) {
            DB::rollback();
            throw new ApiException($e->getMessage());
        }
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

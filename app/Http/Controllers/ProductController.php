<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Responses\ApiException;
use App\Http\Responses\ApiResponse;
use App\Models\Product;
use App\UtilityClasses\NotifyUser;
use App\Services\ProductCategoryServiceInterface;
use App\Services\ProductColorServiceInterface;
use App\Services\ProductImageServiceInterface;
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
    private $productImage;

    public function __construct(
        ProductServiceInterface $product,
        ProductSizeServiceInterface $productSize,
        ProductColorServiceInterface $productColor,
        ProductCategoryServiceInterface $productCategory,
        ProductImageServiceInterface $productImage
    ) {
        $this->product = $product;
        $this->productSize = $productSize;
        $this->productColor = $productColor;
        $this->productCategory = $productCategory;
        $this->productImage = $productImage;
    }
    public function index()
    {
        try {
            $products = $this->product->all();
            return (new ApiResponse('Product List', $products, Response::HTTP_OK, true))->getPayload();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
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
    public function store(ProductStoreRequest $request)
    {
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($requestData['slug'], '-');

        DB::beginTransaction();
        try {
            $product = $this->product->store($requestData);
            $this->productSize->store($requestData['size_id'], $product->id);
            $this->productColor->store($requestData['color_id'], $product->id);
            $this->productCategory->store($requestData['category_id'], $product->id);
            $this->productImage->store($requestData['image'], $product->id);
            (new NotifyUser)->notifyUserForNewProduct($product);
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
    public function update(ProductUpdateRequest $request, Product $product)
    {

        try {
            DB::beginTransaction();
            $updatedProduct = $this->product->update($request->all(), $product);
            if (isset($request['category_id'])) {
                $this->productCategory->store($request['category_id'], $product->id);
            }

            if (isset($request['size_id'])) {
                $this->productSize->store($request['size_id'], $product->id);
            }
            if (isset($request['color_id'])) {
                $this->productColor->store($request['color_id'], $product->id);
            }
            DB::commit();
            return (new ApiResponse('Product updated successfully', $updatedProduct, Response::HTTP_OK, true))->getPayload();
        } catch (\Exception $e) {
            DB::rollback();
            throw new ApiException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('store-update-delete-product', Auth::user())) {
            abort(403); //Only admin user can dlete poduct
        }
        try {
            $product = $this->product->delete($id);
            return (new ApiResponse('product deleted successfully', $product, Response::HTTP_OK, true))->getPayload();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
    }
}

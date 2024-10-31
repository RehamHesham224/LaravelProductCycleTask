<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return self::apiBody([
            'products' => ProductResource::paginate(
                Product::with(['variations', 'media'])->paginate($this->perPage)
            ),
        ])->apiResponse();
    }

    /**
     * @throws \Exception
     */
    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return self::apiBody([
            'product' => ProductResource::make(
                $product
            ),
        ])->apiMessage('data_created_successfully')->apiResponse();
    }

}

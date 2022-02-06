<?php

namespace App\Http\Controllers;

use App\Services\Infrastructure\IModelService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected IModelService $productService;

    public function __construct(IModelService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products =  $this->productService->getAll();
        return response()->json($products);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->productService->getById($id);
        return response()->json($product);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\Infrastructure\IModelService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected IModelService $categoryService;

    public function __construct(IModelService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $customers = $this->categoryService->getAll();
        return response()->json($customers);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $customer = $this->categoryService->getById($id);
        return response()->json($customer);
    }
}

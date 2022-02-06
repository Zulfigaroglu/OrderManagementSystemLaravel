<?php

namespace App\Http\Controllers;

use App\Services\Infrastructure\IModelService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    protected IModelService $customerService;

    public function __construct(IModelService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $customers = $this->customerService->getAll();
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
        $customer = $this->customerService->getById($id);
        return response()->json($customer);
    }
}

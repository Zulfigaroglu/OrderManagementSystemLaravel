<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountCreateRequest;
use App\Http\Requests\DiscountUpdateRequest;
use App\Models\Discount;
use App\Services\Infrastructure\IModelService;
use Illuminate\Http\JsonResponse;

class DiscountController extends Controller
{
    protected IModelService $discountService;

    public function __construct(IModelService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $discounts = $this->discountService->getAll();
        return response()->json($discounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DiscountCreateRequest $request
     * @return JsonResponse
     */
    public function store(DiscountCreateRequest $request): JsonResponse
    {
        $data = $request->all();

        /**
         * @var Discount $discount
         */
        $discount = $this->discountService->create($data);
        return response()->json($discount);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        /**
         * @var Discount $discount
         */
        $discount = $this->discountService->getById($id);
        return response()->json($discount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DiscountUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(DiscountUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        /**
         * @var Discount $discount
         */
        $discount = $this->discountService->update($id, $data);
        return response()->json($discount);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $isDeleted = $this->discountService->delete($id);
        if($isDeleted){
            return response()->json(['message' => 'Discount is successfully deleted.']);
        }
        return response()->json(['message' => 'Discount couldn\'t be deleted.'], 500);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Services\Infrastructure\IModelService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected IModelService $orderService;

    public function __construct(IModelService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $orders = $this->orderService->getAll();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderCreateRequest $request
     * @return JsonResponse
     */
    public function store(OrderCreateRequest $request): JsonResponse
    {
        $data = $request->all();

        /**
         * @var Order $order
         */
        $order = $this->orderService->create($data);
        return response()->json($order->toDto());
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
         * @var Order $order
         */
        $order = $this->orderService->getById($id);
        return response()->json($order->toDto());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(OrderUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        /**
         * @var Order $order
         */
        $order = $this->orderService->update($id, $data);
        return response()->json($order->toDto());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $isDeleted = $this->orderService->delete($id);
        if($isDeleted){
            return response()->json(['message' => 'Order is successfully deleted.']);
        }
        return response()->json(['message' => 'Order couldn\'t be deleted.'], 500);
    }
}

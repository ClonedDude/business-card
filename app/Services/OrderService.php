<?php

namespace App\Services;

use App\Action\Order\CalculateGrandTotal;
use App\Action\Order\CreateOrder;
use App\Action\Order\UpdateOrder;
use App\Action\Order\ValidateOrderData;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use Illuminate\Support\Facades\Pipeline;

class OrderService {
    public function createOrder(array $data)
    {
        $order = Pipeline::send($data)
            ->through([
                ValidateOrderData::class,
                CalculateGrandTotal::class,
                CreateOrder::class,
            ])
            ->thenReturn();

        return $order;
    }

    public function updateOrder(int $id, array $data)
    {
        $order = Order::findOrFail($id);

        $data["order"] = $order;

        $order = Pipeline::send($data)
            ->through([
                ValidateOrderData::class,
                CalculateGrandTotal::class,
                UpdateOrder::class,
            ])
            ->thenReturn();

        return $order;
    }

    public function deleteOrder(int $id)
    {
        $order = Order::find($id);

        return $order->delete();
    }
}
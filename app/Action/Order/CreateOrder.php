<?php

namespace App\Action\Order;

use App\Models\Order;
use Closure;
use Illuminate\Support\Facades\Validator;

class CreateOrder {
    public function handle(array $data, Closure $next)
    {
        $order = Order::create($data);

        return next($order);
    }
}
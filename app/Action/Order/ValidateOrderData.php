<?php

namespace App\Action\Order;

use Closure;
use Illuminate\Support\Facades\Validator;

class ValidateOrderData {
    public function handle(array $data, Closure $next)
    {
        $validated = Validator::make($data, [
            "cart" => ["required", "array"],
            "cart.*.itemable_id" => ["required"],
            "cart.*.itemable_type" => ["required"]
        ])->validate();

        return next($validated);
    }
}
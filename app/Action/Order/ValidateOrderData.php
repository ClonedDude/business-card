<?php

namespace App\Action\Order;

use Closure;
use Illuminate\Support\Facades\Validator;

class ValidateOrderData {
    public function handle(array $data, Closure $next)
    {
        $validated = Validator::make($data, [
            "items" => ["required", "array"],
            "items.*.itemable_id" => ["required"],
            "items.*.itemable_type" => ["required"],
            "items.*.quantity" => ["required"]
        ])->validate();

        return $next($data);
    }
}
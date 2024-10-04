<?php

namespace App\Action\Order;

use App\Models\Order;
use Closure;
use Illuminate\Support\Facades\Validator;

class UpdateOrder {
    public function handle(array $data, Closure $next)
    {
        $data["order"]->update($data);

        $data["order"]->refresh();

        return $next($data);
    }
}
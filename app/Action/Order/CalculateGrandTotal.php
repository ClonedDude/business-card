<?php

namespace App\Action\Order;

use App\Models\Order;
use App\Models\SubscriptionPlan;
use Closure;
use Illuminate\Support\Facades\Validator;

class CalculateGrandTotal {
    public function handle(array $data, Closure $next)
    {
        Validator::make($data, [
            "items.*.itemable_type" => ["required"],
            "items.*.itemable_id" => ["required"],
            "items.*.quantity" => ["required"],
        ])->validate();

        $data["total"] = 0;

        foreach ($data["items"] as $item) {
            switch ($item["itemable_type"]) {
                case "subscription-plan":
                default:
                    $item = SubscriptionPlan::find($item["itemable_id"]);
                    break;
            }

            $data["total"] += $item->price;
        }

        return next($data);
    }
}
<?php

namespace App\Models;

use App\Interfaces\IOrderable;
use App\Traits\ModelUtilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class SubscriptionPlan extends Model implements IOrderable
{
    use HasFactory,
        ModelUtilities;

    protected $fillable = [
        "name",
        "duration",
        "customer_type",
        "price"
    ];

    public function finalize(User $user, array $data)
    {
        $current_date = Carbon::now()->format("Y-m-d");

        $start_date = $user->subscriptions()
            ->orderByDesc("expire_at")
            ->first()
            ->expire_at
            ?? $current_date;

        $subscription = Subscription::create([
            "subscription_plan_id" => $this->id,
            "user_id" => $user->id,
            "company_id" => null,
            "start_at" => $start_date,
            "expire_at" => Carbon::parse($current_date)->format("Y-m-d"),
        ]);
    }
}
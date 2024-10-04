<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanRule extends Model
{
    use HasFactory;

    protected $fillable = [
        "subscription_rule_id",
        "subscription_plan_id",
        "value"
    ];

    public function subscription_rule()
    {
        return $this->belongsTo(SubscriptionRule::class, "subscription_rule_id");
    }

    public function subscription_plan()
    {
        return $this->belongsTo(SubscriptionRule::class, "subscription_plan_id");
    }
}

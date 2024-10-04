<?php

namespace App\Models;

use App\Traits\ModelUtilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory,
        ModelUtilities;

    protected $fillable = [
        "subscription_plan_id",
        "user_id",
        "company_id",
        "start_at",
        "expire_at",
    ];

    public function subscription_plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, "subscription_plan_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function company()
    {
        return $this->belongsTo(Company::class, "company_id");
    }
}

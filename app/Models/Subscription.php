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
}

<?php

namespace App\Models;

use App\Traits\ModelUtilities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,
        ModelUtilities;

    protected $fillable = [
        "customer_id",
        "billcode",
        "total",
        "data",
    ];

    protected $casts = [
        "data" => "json"
    ];
}

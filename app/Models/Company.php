<?php

namespace App\Models;

use App\Traits\ModelUtilities;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory,
        ModelUtilities;

    protected $fillable = [
        "admin_id",
        "registration_number",
        "address",
        "phone_number",
        "fax",
        "email",
    ];
    
    public function admin()
    {
        return $this->belongsTo(User::class, "admin_id");
    }

    public function logoUrl() : Attribute
    {
        return Attribute::make(
            get: function () {
                $this->getFirstMedia("logo")->getFullUrl();
            }
        );
    }
}

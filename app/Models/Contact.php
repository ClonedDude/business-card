<?php

namespace App\Models;

use App\Traits\ModelUtilities;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory,
        ModelUtilities;

    protected $fillable = [
        "user_id",
        "company_id",
        "name",
        "address",
        "phone_number",
        "fax",
        "email",
    ];

    static function exists(int $id)
    {
        $company = Contact::find($id);

        return !is_null($company);
    }

    public function profilePictureUrl() : Attribute
    {
        return Attribute::make(
            get: function () {
                $this->getFirstMedia("profile-picture")->getFullUrl();
            }
        );
    }
}

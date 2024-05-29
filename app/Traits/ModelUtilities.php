<?php

namespace App\Traits;

trait ModelUtilities
{
    static function exists(int $id)
    {
        $company = self::find($id);

        return !is_null($company);
    }

}
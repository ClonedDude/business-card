<?php

namespace App\Interfaces;

use App\Models\User;

interface IOrderable
{
    public function finalize(User $user, array $data);
}
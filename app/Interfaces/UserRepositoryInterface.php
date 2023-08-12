<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;

interface UserRepositoryInterface
{
    public function getAll();
}

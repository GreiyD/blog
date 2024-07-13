<?php

namespace App\Contracts;

use App\Models\User;

interface RegisterActionContract
{
    public function __invoke(array $data): User;
}

<?php

namespace App\Contracts;

interface Reactionable
{
    public function likes();
    public function dislikes();
}

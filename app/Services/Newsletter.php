<?php

namespace App\Services;

interface Newsletter
{
    public function subscribe(string $email, string $list = null);
}

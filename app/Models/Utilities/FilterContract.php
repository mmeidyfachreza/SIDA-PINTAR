<?php

namespace App\Models\Utilities;

interface FilterContract
{
    public function handle($value): void;
}

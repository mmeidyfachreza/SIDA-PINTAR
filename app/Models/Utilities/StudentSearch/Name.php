<?php

namespace App\Models\Utilities\ConsumerFilters;

use App\Models\Utilities\QueryFilter;
use App\Models\Utilities\FilterContract;

class Name extends QueryFilter implements FilterContract
{
    public function handle($value = Null): void
    {
        $this->query->where('name','like','%'.$value.'%');
    }
}

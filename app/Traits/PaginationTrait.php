<?php

namespace App\Traits;

trait PaginationTrait
{
    public function paginationAttribute($inputs)
    {
        $inputs['limit'] ??= 10;
        $inputs['page'] = (isset($inputs['page']) && $inputs['limit'] !== -1) ? $inputs['page'] : 1;

        return $inputs;
    }
}

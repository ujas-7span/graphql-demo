<?php

namespace App\Services;

use App\Models\Country;
use App\Traits\PaginationTrait;

class CountryService
{
    use PaginationTrait;

    public function __construct(private Country $countryObj)
    {
    }

    public function collection($inputs = null)
    {
        $inputs = $this->paginationAttribute($inputs);

        $country = $this->countryObj->select($inputs['select']);
        
        if (! empty($inputs['search'])) {
            $country = $country->search($inputs['search']);
        }

        $inputs['limit'] = $inputs['limit'] == -1 ? $country->count() : $inputs['limit'];

        return $country->paginate($inputs['limit'], ['*'], 'page', $inputs['page']);
    }
}

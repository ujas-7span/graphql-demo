<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_code',
    ];

     public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', '%' . $search . '%')->orWhere('country_code', 'LIKE', '%' . $search . '%');
    }
}

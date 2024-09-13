<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    public function scopeDateFrom(Builder $query, $dateFrom, $strict = false)
    {
        return $query->when($dateFrom !==null || $strict, fn($query) => $query->where('created_at', '>=', $dateFrom));
    }

    public function scopeDateTo(Builder $query, $dateTo, $strict = false)
    {
        return $query->when($dateTo !==null || $strict, fn($query) => $query->where('created_at', '<=', $dateTo));
    }
}

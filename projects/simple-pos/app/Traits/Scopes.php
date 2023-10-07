<?php

namespace App\Traits;

trait Scopes
{
    public function scopeMonthAndYear($query, $request)
    {
        $month = $request->month;
        $year = $request->year;

        return $query->when($month, function ($query) use ($month) {
            return $query->whereMonth('created_at', $month);
        })->when($year, function ($query) use ($year) {
            return $query->whereYear('created_at', $year);
        });
    }
}

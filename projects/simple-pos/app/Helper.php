<?php

function rupiah($number, $prefix = 'Rp ')
{
    $rupiah = $prefix . number_format($number, 0, '', '.');
    return $rupiah;
}

function getUser()
{
    return auth()->user();
}

function dateFormater($date, $format = 'd/m/Y, H:i:s')
{
    return Carbon\Carbon::parse($date)->format($format);
}

function allMonths()
{
    return [
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
    ];
}

function allYears($year = 2023, $previous = 0, $next = 0)
{
    $years = [];
    for ($i = $year; $i >= $year - $previous; $i--) {
        $years[$i] = $i;
    }

    for ($i = $year + 1; $i <= $year + $next; $i++) {
        $years[$i] = $i;
    }

    // sort by key
    ksort($years);
    return $years;
}

function listColor()
{
    return [
        '#e67e22',
        '#dc3545',
        '#28a745',
        '#ffc107',
        '#17a2b8',
        '#605ca8',
        '#f012be',
        '#001f3f',
        '#d81b60',
        '#39cccc'
    ];
}

<?php

if (!function_exists('format_rupiah')) {
    /**
     * Format angka menjadi format rupiah.
     *
     * @param float|int $number
     * @return string
     */
    function format_rupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

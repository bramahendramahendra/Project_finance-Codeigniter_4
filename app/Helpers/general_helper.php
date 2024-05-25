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

if (!function_exists('parse_rupiah')) {
    /**
     * Format angka dalam format rupiah menjadi integer.
     *
     * @param string $rupiah
     * @return int
     */
    function parse_rupiah($rupiah)
    {
        $number = preg_replace('/[^0-9]/', '', $rupiah);
        return (int)$number;
    }
}

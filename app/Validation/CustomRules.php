<?php namespace App\Validation;

class CustomRules
{
    public function validate_rupiah(string $str, string &$error = null): bool
    {
        if (preg_match('/^Rp\s*[0-9]+(.[0-9]{3})*(,[0-9]{0,2})?$/', $str)) {
            return true;
        } else {
            $error = 'Format Jumlah Tagihan tidak valid.';
            return false;
        }
    }
}

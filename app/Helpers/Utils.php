<?php

namespace App\Helpers;

class Utils
{
    /**
     * Remove todos os caracteres não numéricos de um valor.
     *
     * @param mixed $value
     * @return int
     */
    public static function sanitizeInteger($value): int
    {
        // Converte o valor para string e remove tudo que não for dígito
        return (int) preg_replace('/\D+/', '', (string) $value);
    }

    public static function sanitizeCurrency($value): float
    {
        $value = trim($value);
        $value = preg_replace('/[^\d,.-]/', '', $value);

        if (strpos($value, ',') !== false && strpos($value, '.') !== false) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        } elseif (strpos($value, ',') !== false) {
            $value = str_replace(',', '.', $value);
        }

        return (float) $value;
    }
}
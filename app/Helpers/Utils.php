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
}
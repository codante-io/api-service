<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         // Remove caracteres não numéricos
         $cpf = preg_replace('/[^0-9]/', '', $value);

         // Verifica se o CPF tem 11 dígitos
         if (strlen($cpf) != 11) {
            $fail('O CPF fornecido é inválido.');
         }
 
         // Verifica se todos os dígitos são iguais
         if (preg_match('/(\d)\1{10}/', $cpf)) {
             $fail('O CPF fornecido é inválido.');
         }
 
         // Calcula os dígitos verificadores
         for ($t = 9; $t < 11; $t++) {
             for ($d = 0, $c = 0; $c < $t; $c++) {
                 $d += $cpf[$c] * (($t + 1) - $c);
             }
 
             $d = ((10 * $d) % 11) % 10;
 
             if ($cpf[$c] != $d) {
                $fail('O CPF fornecido é inválido.');
             }
         }
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return 'O CPF fornecido é inválido.';
    }
}

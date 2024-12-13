<?php

namespace App\Rules;

use App\Models\Event;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;


class TestingRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }

    function codeAccessInvalid()
    {
        return '';
    }

    function codeAccessExpired()
    {
        return '';
    }
}

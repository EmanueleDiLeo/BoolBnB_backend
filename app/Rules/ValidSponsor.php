<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Sponsor;

class ValidSponsor implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail) :void
    {
        //
    }

    public function passes(string $attribute, mixed $value) {
        if(Sponsor::find($value)){
            return true;
        }
        return false;
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class registerRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'email.required'  => 'Deze email is al in gebruik',
            'password.min:6'  => 'Het wachtwoord moet minimaal 6 tekens hebben',
        ];
    }
}

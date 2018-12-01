<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KeyIsID implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
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
        foreach(array_keys($value) as $keyId)
        {
            if(!$this->modelClass::find($keyId))
                return false;
        }
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Odeslaný klíč nebyl nalezen.';
    }
}

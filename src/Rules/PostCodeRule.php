<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class PostCodeRule.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 09/09/2020
 */
class PostCodeRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->checkPostCode($value);
    }

    /**
     * Validate post code.
     *
     * @param string|null $string
     *
     * @return bool
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 09/09/2020
     */
    private function checkPostCode(?string $string): bool
    {
        if ($string === null) {
            return false;
        }

        if (!preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', $string)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return trans('polish-validation::validation.post_code');
    }
}

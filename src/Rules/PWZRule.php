<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class PWZRule.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 09/09/2020
 */
class PWZRule implements Rule
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
        return $this->checkPWZ($value);
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
    private function checkPWZ(?string $string): bool
    {
        if ($string === null) {
            return false;
        }

        if (strlen($string) !== 7) {
            return false;
        }

        // Get control number.
        $control = (int)substr($string, 0, 1);

        if ($control === 0) {
            return false;
        }

        // Calculate control number.
        $controlSum = 0;
        for ($x = 1; $x <= 7; $x++) {
            $controlSum += ((int)substr($string, $x, 1) * $x);
        }

        $calculatedControl = ($controlSum % 11);

        if ($calculatedControl !== $control) {
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
        return trans('polish-validation::validation.PWZ');
    }
}

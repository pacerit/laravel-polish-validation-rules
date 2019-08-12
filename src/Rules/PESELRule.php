<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class PESELRule
 *
 * @package PacerIT\LaravelPolishValidationRules\Rules
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 * @since 2019-08-12
 */
class PESELRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return boolean
     */
    public function passes($attribute, $value)
    {
        return $this->checkPESEL($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return trans('polish-validation::validation.PESEL');
    }

    /**
     * Check if given PESEL number is valid
     *
     * @param string $string
     * @return boolean
     * @see http://phpedia.pl/wiki/PESEL Souce of this algorithm
     * @since 2019-08-12
     */
    private function checkPESEL(string $string): bool
    {
        if (! preg_match('/^[0-9]{11}$/', $string)) {
            return false;
        }

        $arrSteps = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $intSum = 0;
        for ($i = 0; $i < 10; $i++) {
            $intSum += $arrSteps[$i] * $string[$i];
        }

        $int = 10 - $intSum % 10;
        $intControlNr = ($int == 10) ? 0 : $int;

        if ($intControlNr == $string[10]) {
            return true;
        }

        return false;
    }

}

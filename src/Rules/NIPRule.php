<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class NIPRule
 *
 * @package Rules
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 * @since 2019-08-12
 */
class NIPRule implements Rule
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
        return $this->checkNIP($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return trans('polish-validation::validation.NIP');
    }

    /**
     * Check if given string is valid NIP number
     *
     * @param string $string
     * @return boolean
     * @see http://phpedia.pl/wiki/NIP Souce of this algorithm
     * @since 2019-08-12
     */
    private function checkNIP(string $string): bool
    {
        $str = preg_replace('/[^0-9]+/', '', $string);

        if (strlen($string) !== 10) {
            return false;
        }

        $arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
        $intSum = 0;

        for ($i = 0; $i < 9; $i++) {
            $intSum += $arrSteps[$i] * $string[$i];
        }

        $int = $intSum % 11;
        $intControlNr = $int === 10 ? 0 : $int;

        if ($intControlNr == $string[9]) {
            return true;
        }

        return false;
    }

}

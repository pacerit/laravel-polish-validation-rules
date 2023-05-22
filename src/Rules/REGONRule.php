<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class REGONRule.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class REGONRule implements Rule
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
        if ($value === null) {
            return false;
        }

        return match (strlen($value)) {
            9       => $this->checkREGON($value),
            14      => $this->checkLongREGON($value),
            default => false,
        };
    }

    /**
     * Check if given REGON number is valid - 9 digit version.
     *
     * @param null|string $string
     *
     * @return bool
     *
     * @see http://phpedia.pl/wiki/REGON Souce of this algorithm
     * @since 2019-08-12
     */
    private function checkREGON(?string $string): bool
    {
        $arrSteps = [8, 9, 2, 3, 4, 5, 6, 7];
        $intSum = 0;

        for ($i = 0; $i < 8; $i++) {
            $intSum += $arrSteps[$i] * $string[$i];
        }

        $int = $intSum % 11;
        $intControlNr = ($int == 10) ? 0 : $int;

        if ($intControlNr == $string[8]) {
            return true;
        }

        return false;
    }

    /**
     * Check if given REGON number is valid - 14 digits version.
     *
     * @param null|string $string
     *
     * @return bool
     *
     * @see http://phpedia.pl/wiki/REGON Souce of this algorithm
     * @since 2023-05-22
     */
    private function checkLongRegon(?string $string): bool
    {
        $arrSteps = [2, 4, 8, 5, 0, 9, 7, 3, 6, 1, 2, 4, 8];
        $intSum = 0;

        for ($i = 0; $i < 13; $i++) {
            $intSum += $arrSteps[$i] * $string[$i];
        }

        $int = $intSum % 11;
        $intControlNr = ($int == 10) ? 0 : $int;

        if ($intControlNr == $string[13]) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return trans('polish-validation::validation.REGON');
    }
}

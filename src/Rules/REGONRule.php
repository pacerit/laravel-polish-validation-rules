<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

/**
 * Class REGONRule.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class REGONRule
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
        return $this->checkREGON($value);
    }

    /**
     * Check if given REGON number is valid.
     *
     * @param string $string
     *
     * @return bool
     *
     * @see http://phpedia.pl/wiki/REGON Souce of this algorithm
     * @since 2019-08-12
     */
    private function checkREGON(string $string): bool
    {
        if (strlen($string) != 9) {
            return false;
        }

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
}

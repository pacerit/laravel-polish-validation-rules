<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class PassportNumberRule.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class PassportNumberRule implements Rule
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
        return $this->checkPassportNumber($value);
    }

    /**
     * Check if given string is valid passport number.
     *
     * @param null|string $string
     *
     * @return bool
     */
    private function checkPassportNumber(?string $string): bool
    {
        if ($string === null) {
            return false;
        }

        $string = str_replace('-', '', $string);
        $string = str_replace(' ', '', $string);

        if (strlen($string) != 9) {
            return false;
        }

        $identityCard = strtoupper($string);

        $def_value = ['0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9,
                      'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19,
                      'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29,
                      'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 'Z' => 35,];

        $importance = [7,  3,  0,  1,  7,  3,  1,  7,  3];

        $identityCardSum = 0;

        for ($i = 0; $i < 9; $i++) {
            if ($i < 2 && $def_value[$identityCard[$i]] < 10) {
                return false;
            } elseif ($i > 1 && $def_value[$identityCard[$i]] > 9) {
                return false;
            }

            $identityCardSum += ((int) $def_value[$identityCard[$i]]) * $importance[$i];
        }

        if ($identityCardSum % 10 != $identityCard[2]) {
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
        return trans('polish-validation::validation.passport_number');
    }
}

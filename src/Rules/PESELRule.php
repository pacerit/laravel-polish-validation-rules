<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

/**
 * Class PESELRule.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 */
class PESELRule implements Rule
{

    // Gender digit position in PESEL number.
    const GENDER_POSITION = 9;
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     * @param array  $parameters
     *
     * @return bool
     */
    public function passes($attribute, $value, $parameters = [])
    {
        // First we check if PESEL is valid. If not, there is no need to check other attributes.
        if (!$this->checkPESEL($value)) {
            return false;
        }

        // Get parameters.
        $parameters = explode(':', (string) Arr::first($parameters));

        $result = true;
        foreach ($parameters as $mode) {
            switch ($mode) {
                case 'gender_male':
                    $result = $this->validateGender($value);
                    break;

                case 'gender_female':
                    $result = $this->validateGender($value, self::GENDER_FEMALE);
                    break;

                default:
                    return true;
            }
        }

        return $result;
    }

    /**
     * Check if given PESEL number is valid.
     *
     * @param null|string $string
     *
     * @return bool
     *
     * @see http://phpedia.pl/wiki/PESEL Souce of this algorithm
     */
    private function checkPESEL(?string $string): bool
    {
        if ($string === null) {
            return false;
        }

        if (!preg_match('/^[0-9]{11}$/', $string)) {
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

    /**
     * Validate gender in PESEL number.
     *
     * @param string $pesel
     * @param int    $gender
     *
     * @return bool
     */
    private function validateGender(string $pesel, int $gender = self::GENDER_MALE): bool
    {
        $genderFromPesel = $pesel[self::GENDER_POSITION];
        $result = (bool) ($genderFromPesel % 2);

        if ($gender === self::GENDER_MALE && $result) {
            return true;
        }

        if ($gender === self::GENDER_FEMALE && !$result) {
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
        return trans('polish-validation::validation.PESEL');
    }
}

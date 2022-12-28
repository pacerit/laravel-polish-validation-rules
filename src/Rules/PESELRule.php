<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

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

    // Available parameters.
    const PARAMETER_GENDER_MALE = 'gender_male';
    const PARAMETER_GENDER_FEMALE = 'gender_female';
    const PARAMETER_BORN_BEFORE = 'born_before';
    const PARAMETER_BORN_AFTER = 'born_after';

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
        $parameters = implode(',', $parameters);
        $parameters = explode(':', (string)$parameters);

        $result = true;
        foreach ($parameters as $optionWithParameters) {
            // Get option and parameters.
            $parameterData = explode(',', $optionWithParameters);
            $option = Arr::first($parameterData);

            switch ($option) {
                case self::PARAMETER_GENDER_MALE:
                    $result = $this->validateGender($value);
                    break;

                case self::PARAMETER_GENDER_FEMALE:
                    $result = $this->validateGender($value, self::GENDER_FEMALE);
                    break;

                case self::PARAMETER_BORN_BEFORE:

                    $result = $this->validateBirthDate($value, (string)Arr::get($parameterData, 1), true);
                    break;

                case self::PARAMETER_BORN_AFTER:
                    $result = $this->validateBirthDate($value, (string)Arr::get($parameterData, 1));
                    break;

                default:
                    $result = true;
            }

            // Fail on first error.
            if (!$result) {
                return false;
            }
        }

        return true;
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
            // Check birth date.
            $birthDate = $this->getBirthDate($string);
            if ($birthDate === null) {
                return false;
            }

            if ($birthDate->isBefore(Carbon::create(1800))
                || $birthDate->isAfter(Carbon::create(2300))
            ) {
                return false;
            }

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
     * Get birth date from PESEL to properly validate numbers like "00000000000", "44444444444".
     *
     * @param string $pesel
     *
     * @return Carbon|null
     *
     * @see https://github.com/KKSzymanowski/PESEL/blob/master/src/Pesel.php - Source of this method.
     */
    private function getBirthDate(string $pesel): ?Carbon
    {
        // First 6 numbers of PESEL, encode birth date - year, month and day respectively.
        $year = substr($pesel, 0, 2);
        $month = substr($pesel, 2, 2);
        $day = substr($pesel, 4, 2);

        /*
         * Get century number - first number of month.
         * 8,9 - for 1800 - 1899
         * 0,1 - for 1990 - 1999
         * 2,3 - for 2000 - 2099
         * 4,5 - for 2100 - 2199
         * 6,7 - for 2200 - 2299
         *
         * See - https://pl.wikipedia.org/wiki/PESEL#Data_urodzenia
         */
        $century = (int)substr($pesel, 2, 1);

        /*
         * Add offset of 2 - that's because the numbers 8 and 9 represent an earlier century than the other numbers.
         * Offset allows you to eliminate the calculation problem.
         * Numbers after add offset - 2,3,4,5,6,7,8,9,10,11
         */
        $century += 2;

        /*
         * Get only integers from number set.
         * Result numbers - 2,3,4,5,6,7,8,9,0,1
         */
        $century %= 10;

        /*
         * Calculated value is the number that needs to be added to base century to get the correct century for the
         * entered PESEL number.
         *
         * Results for each numbers should be:
         * 8,9 - 0
         * 0,1 - 1
         * 2,3 - 2
         * 4,5 - 3
         * 6,7 - 4
         */
        $century = round($century / 2, 0, PHP_ROUND_HALF_DOWN);

        /*
         * The number 18 is the base century value as the PESEL number is issued to people born after year 1800.
         */
        $century += 18;
        $year = $century.$year;


        // If number after modulo is smaller than 10, add "0" on the begin on month number.
        $month = str_pad($month % 20, 2, '0', STR_PAD_LEFT);

        try {
            if ($day < 1
                || $month < 1
                || $month > 12
                || $day > cal_days_in_month(CAL_GREGORIAN, $month, $year)
            ) {
                return null;
            }

            return Carbon::parse(sprintf('%s-%s-%s', $year, $month, $day));
        } catch (InvalidFormatException $exception) {
            return null;
        }
    }

    /**
     * Validate if date is before or after given date.
     *
     * @param string $pesel
     * @param string $date
     * @param bool $before
     *
     * @return bool
     */
    private function validateBirthDate(string $pesel, string $date, bool $before = false): bool
    {
        // Get birth date from PESEL.
        $birthDate = $this->getBirthDate($pesel);

        // Parse date from request.
        try {
            $dateToCompare = Carbon::parse($date);
        } catch (InvalidFormatException $exception) {
            return false;
        }

        if ($before) {
            return $birthDate->isBefore($dateToCompare);
        }

        return $birthDate->isAfter($dateToCompare);
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

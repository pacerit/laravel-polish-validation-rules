<?php

namespace PacerIT\LaravelPolishValidationRules\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;

/**
 * Class PostCodeRule.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 */
class PostCodeRule implements Rule
{
    const REGEX_DASH_REQUIRED = '/^[0-9]{2}-[0-9]{3}$/Du';
    const REGEX_DASH_NOT_ALLOWED = '/^[0-9]{5}$/Du';
    const REGEX_DASH_OPTIONAL = '/^[0-9]{2}-?[0-9]{3}$/Du';

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
        // Get first parameter.
        $mode = (string) Arr::first($parameters);

        switch ($mode) {
            case 'with_dash':
                return $this->checkPostCode($value, 1);

            case 'without_dash':
                return $this->checkPostCode($value, 2);

            default:
                return $this->checkPostCode($value);
        }
    }

    /**
     * Validate post code.
     *
     * @param string|null $string
     *
     * @return bool
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    private function checkPostCode(?string $string, int $mode = 0): bool
    {
        if ($string === null) {
            return false;
        }

        switch ($mode) {
            case 1:
                $regex = self::REGEX_DASH_REQUIRED;
                break;

            case 2:
                $regex = self::REGEX_DASH_NOT_ALLOWED;
                break;

            default:
                $regex = self::REGEX_DASH_OPTIONAL;
                break;
        }

        return preg_match($regex, $string);
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

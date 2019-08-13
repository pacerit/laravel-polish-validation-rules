<?php

namespace Tests\Unit;

use Illuminate\Contracts\Validation\Rule;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractRuleTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
abstract class AbstractRuleTest extends TestCase
{
    /**
     * @var Rule
     */
    protected $rule;
}

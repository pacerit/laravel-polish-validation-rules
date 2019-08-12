<?php

namespace Tests\Unit;

use Illuminate\Contracts\Validation\Rule;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractRuleTest
 *
 * @package Tests\Unit
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 * @since 2019-08-12
 */
abstract class AbstractRuleTest extends TestCase
{

    /**
     * @var Rule $rule
     */
    protected $rule;

}

<?php

namespace Tests\Unit;

use Illuminate\Contracts\Validation\Rule;
use Orchestra\Testbench\TestCase;
use PacerIT\LaravelPolishValidationRules\Providers\LaravelPolishValidationRulesServiceProvider;

/**
 * Class AbstractRuleTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 */
abstract class AbstractRuleTest extends TestCase
{
    /**
     * @var Rule
     */
    protected $rule;

    /**
     * @inheritDoc
     */
    protected function getPackageProviders($app)
    {
        return [LaravelPolishValidationRulesServiceProvider::class];
    }

}

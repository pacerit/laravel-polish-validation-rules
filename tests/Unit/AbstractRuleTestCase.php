<?php

namespace PacerIT\LaravelPolishValidationRules\Tests\Unit;

use Illuminate\Contracts\Validation\Rule;
use Orchestra\Testbench\TestCase;
use PacerIT\LaravelPolishValidationRules\Providers\LaravelPolishValidationRulesServiceProvider;

/**
 * Class AbstractRuleTestCase.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 */
abstract class AbstractRuleTestCase extends TestCase
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

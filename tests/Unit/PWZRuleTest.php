<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\PWZRule;

/**
 * Class PWZRuleTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class PWZRuleTest extends AbstractRuleTest
{
    /**
     * Set up test.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new PWZRule();
    }

    /**
     * Test valid PWZ number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testValidPWZ()
    {
        $this->assertTrue($this->rule->passes('PWZ', 5425740));
    }

    /**
     * Test not valid PWZ number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testNotValidPWZ()
    {
        // To long.
        $this->assertFalse($this->rule->passes('PWZ', 00000000));
        // Starts with 0.
        $this->assertFalse($this->rule->passes('PWZ', 0000000));
        // Control sum not valid.
        $this->assertFalse($this->rule->passes('PWZ', 1000000));

    }

    /**
     * Test null PWZ number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 02/12/2019
     */
    public function testNullPWZ()
    {
        $this->assertFalse($this->rule->passes('PWZ', null));
    }
}

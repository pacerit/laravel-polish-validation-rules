<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\REGONRule;

/**
 * Class REGONRuleTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class REGONRuleTest extends AbstractRuleTest
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
        $this->rule = new REGONRule();
    }

    /**
     * Test valid REGON number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testValidREGON()
    {
        $this->assertEquals(true, $this->rule->passes('regon', '499273139'));
    }

    /**
     * Test not valid REGON number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testNotValidREGON()
    {
        $this->assertEquals(false, $this->rule->passes('regon', '499273138'));
    }

    /**
     * Test null REGON number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 02/12/2019
     */
    public function testNullREGON()
    {
        $this->assertFalse($this->rule->passes('regon', null));
    }
}

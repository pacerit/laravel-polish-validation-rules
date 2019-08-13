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
    public function setUp()
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
        $this->assertEquals(true, $this->rule->passes('pesel', '499273139'));
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
        $this->assertEquals(false, $this->rule->passes('pesel', '499273138'));
    }
}

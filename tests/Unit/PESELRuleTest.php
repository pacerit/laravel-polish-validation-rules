<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\PESELRule;

/**
 * Class PESELRuleTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class PESELRuleTest extends AbstractRuleTest
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
        $this->rule = new PESELRule();
    }

    /**
     * Valid PESEL test.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testValidPESEL()
    {
        $validPesel = '39102999741';

        $this->assertTrue($this->rule->passes('pesel', $validPesel));
    }

    /**
     * Not valid PESEL test.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testNotValidPESEL()
    {
        $notValidPesel = '39102999742';

        $this->assertFalse($this->rule->passes('pesel', $notValidPesel));
    }

    /**
     * Test null PESEL number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 02/12/2019
     */
    public function testNullPESEL()
    {
        $this->assertFalse($this->rule->passes('pessel', null));
    }
}

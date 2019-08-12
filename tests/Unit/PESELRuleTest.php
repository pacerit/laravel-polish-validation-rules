<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\PESELRule;

/**
 * Class PESELRuleTest
 *
 * @package Tests\Unit
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 * @since 2019-08-12
 */
class PESELRuleTest extends AbstractRuleTest
{

    /**
     * Set up test
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     * @since 2019-08-12
     */
    public function setUp()
    {
        parent::setUp();
        $this->rule = New PESELRule();
    }

    /**
     * Valid PESEL test
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     * @since 2019-08-12
     */
    public function testValidPESEL()
    {
        $validPesel = '39102999741';

        $this->assertEquals(true, $this->rule->passes('pesel', $validPesel));
    }

    /**
     * Not valid PESEL test
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     * @since 2019-08-12
     */
    public function testNotValidPESEL()
    {
        $notValidPesel = '39102999742';

        $this->assertEquals(false, $this->rule->passes('pesel', $notValidPesel));
    }

}

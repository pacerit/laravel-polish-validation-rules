<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\NIPRule;

/**
 * Class NIPRuleTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class NIPRuleTest extends AbstractRuleTest
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
        $this->rule = new NIPRule();
    }

    /**
     * Test valid NIP number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testValidNIP()
    {
        $this->assertEquals(true, $this->rule->passes('nip', '7973640218'));
    }

    /**
     * Test not valid NIP number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testNotValidNIP()
    {
        $this->assertEquals(false, $this->rule->passes('nip', '7973640217'));
    }
}

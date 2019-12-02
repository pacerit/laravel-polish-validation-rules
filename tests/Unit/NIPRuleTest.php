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
        $this->assertTrue($this->rule->passes('nip', '7973640218'));
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
        $this->assertFalse($this->rule->passes('nip', '7973640217'));
    }

    /**
     * Test null NIP number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 02/12/2019
     */
    public function testNullNIP()
    {
        $this->assertFalse($this->rule->passes('nip', null));
    }
}

<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\IDCardNumberRule;

/**
 * Class IDCardNUmberTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class IDCardNUmberTest extends AbstractRuleTest
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
        $this->rule = new IDCardNumberRule();
    }

    /**
     * Test valid ID Card number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testValidIDCardNumber()
    {
        $this->assertTrue($this->rule->passes('id_card_number', 'BAC545045'));
    }

    /**
     * Test valid ID Card number (with space).
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testValidIDCardNumberWithSpace()
    {
        $this->assertTrue($this->rule->passes('id_card_number', 'BAC 545045'));
    }

    /**
     * Test valid ID Card number (with dash).
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testValidIDCardNumberWithDash()
    {
        $this->assertTrue($this->rule->passes('id_card_number', 'BAC-545045'));
    }

    /**
     * Test not valid ID Card number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    public function testNotValidIDCardNumber()
    {
        $this->assertFalse($this->rule->passes('id_card_number', 'ATL0000'));
    }

    /**
     * Test ID Card number is null.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 02/12/2019
     */
    public function testNullIDCardNumber()
    {
        $this->assertFalse($this->rule->passes('id_card_number', null));
    }
}

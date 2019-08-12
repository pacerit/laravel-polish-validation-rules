<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\IDCardNumberRule;

/**
 * Class IDCardNUmberTest
 *
 * @package Tests\Unit
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 * @since 2019-08-12
 */
class IDCardNUmberTest extends AbstractRuleTest
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
        $this->rule = New IDCardNumberRule();
    }

    /**
     * Test valid NIP number
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     * @since 2019-08-12
     */
    public function testValidIDCardNumber()
    {
        $this->assertEquals(true, $this->rule->passes('id_card_number', 'BAC545045'));
    }

    /**
     * Test valid NIP number (with space)
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     * @since 2019-08-12
     */
    public function testValidIDCardNumberWithSpace()
    {
        $this->assertEquals(true, $this->rule->passes('id_card_number', 'BAC 545045'));
    }

    /**
     * Test valid NIP number (with dash)
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     * @since 2019-08-12
     */
    public function testValidIDCardNumberWithDash()
    {
        $this->assertEquals(true, $this->rule->passes('id_card_number', 'BAC-545045'));
    }

    /**
     * Test not valid NIP number
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     * @since 2019-08-12
     */
    public function testNotValidIDCardNumber()
    {
        $this->assertEquals(false, $this->rule->passes('id_card_number', 'ATL0000'));
    }

}

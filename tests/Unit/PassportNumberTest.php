<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\PassportNumberRule;

/**
 * Class PassportNumberTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 */
class PassportNumberTest extends AbstractRuleTest
{
    /**
     * Set up test.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new PassportNumberRule();
    }

    /**
     * Test valid Passport number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testValidPassportNumber()
    {
        $this->assertTrue($this->rule->passes('passport_number', 'AB4123456'));
        $this->assertTrue($this->rule->passes('passport_number', 'BA2343304'));
        $this->assertTrue($this->rule->passes('passport_number', 'AV6331817'));
    }

    /**
     * Test valid Passport number (with space).
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testValidPassportNumberWithSpace()
    {
        $this->assertTrue($this->rule->passes('passport_number', 'AB 4123456'));
        $this->assertTrue($this->rule->passes('passport_number', 'BF 8804448'));
        $this->assertTrue($this->rule->passes('passport_number', 'ED 6651278'));
    }

    /**
     * Test valid Passport number (with dash).
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testValidPassportNumberWithDash()
    {
        $this->assertTrue($this->rule->passes('passport_number', 'AB-4123456'));
    }

    /**
     * Test not valid Passport number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testNotValidPassportNumber()
    {
        $this->assertFalse($this->rule->passes('passport_number', 'AB4121456'));
    }

    /**
     * Test Passport number is null.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testNullPassportNumber()
    {
        $this->assertFalse($this->rule->passes('passport_number', null));
    }
}

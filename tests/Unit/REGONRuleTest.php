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
        $validNumbers = [
            '734530267',
            '053955500',
            '253338390',
            '947187850',
            '130433149',
            '843308426',
            '386679662',
            '347116739',
            '988319794',
            '303398620',
            '75147943205580',
            '25713726382524',
            '48323221384555',
            '30936418398037',
            '63946570931273',
            '45829482847518',
            '27025051044606',
            '94035209178263',
            '20978490719275',
            '08942642204556',
        ];

        foreach ($validNumbers as $number) {
            $this->assertTrue($this->rule->passes('regon', $number));
        }
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
        $this->assertFalse($this->rule->passes('regon', '499273138'));
        $this->assertFalse($this->rule->passes('regon', '490003138'));
        $this->assertFalse($this->rule->passes('regon', '574625967547362'));
        $this->assertFalse($this->rule->passes('regon', '653231231237362'));
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

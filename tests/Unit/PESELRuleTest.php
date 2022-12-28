<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Validator;
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
    public function setUp(): void
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
        $notValidPesel = [
            '39102999742',
            '00000000000',
            '44444444444',
            '19222900001',
        ];

        foreach ($notValidPesel as $pesel) {
            $this->assertFalse($this->rule->passes('pesel', $pesel));
        }
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

    /**
     * Test PESEL "gender_male" option.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testGenderMaleOption()
    {
        $rules = ['pesel' => 'PESEL:gender_male'];

        $validMalePesel = [
            '07262444973',
            '18011233773',
            '26121492032',
        ];

        // Test for male gender.
        foreach ($validMalePesel as $validPesel) {
            $data = ['pesel' => $validPesel];
            $validator = Validator::make($data, $rules);
            $this->assertFalse($validator->fails());
        }

        $rules = ['pesel' => 'PESEL:gender_female'];

        foreach ($validMalePesel as $validPesel) {
            $data = ['pesel' => $validPesel];
            $validator = Validator::make($data, $rules);
            $this->assertTrue($validator->fails());
        }
    }

    /**
     * Test PESEL "gender_female" option.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testGenderFemaleOption()
    {
        $rules = ['pesel' => 'PESEL:gender_female'];

        $validFemalePesel = [
            '08260713768',
            '59092028627',
            '20083149926',
        ];

        // Test for female gender.
        foreach ($validFemalePesel as $validPesel) {
            $data = ['pesel' => $validPesel];
            $validator = Validator::make($data, $rules);
            $this->assertFalse($validator->fails());
        }

        $rules = ['pesel' => 'PESEL:gender_male'];

        foreach ($validFemalePesel as $validPesel) {
            $data = ['pesel' => $validPesel];
            $validator = Validator::make($data, $rules);
            $this->assertTrue($validator->fails());
        }
    }
}

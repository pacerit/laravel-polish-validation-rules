<?php

namespace PacerIT\LaravelPolishValidationRules\Tests\Unit;

use Illuminate\Support\Facades\Validator;
use PacerIT\LaravelPolishValidationRules\Rules\PostCodeRule;

/**
 * Class PostCodeRuleTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 */
class PostCodeRuleTest extends AbstractRuleTestCase
{
    /**
     * Set up test.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->rule = new PostCodeRule();
    }

    /**
     * Test valid PostCode number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testValidPostCode()
    {
        $this->assertTrue($this->rule->passes('post_code', '72-200'));
        $this->assertTrue($this->rule->passes('post_code', '72-200'));
    }

    /**
     * Test not valid PostCode number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testNotValidPostCode()
    {
        $this->assertFalse($this->rule->passes('post_code', '7220'));
    }

    /**
     * Test null PostCode number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testNullPostCode()
    {
        $this->assertFalse($this->rule->passes('post_code', null));
    }

    /**
     * Test PostCode "with_dash" option.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testWithDashOption()
    {
        $rules = ['post_code' => 'post_code:with_dash'];

        // Test with correct data.
        $data = ['post_code' => '72-200'];
        $validator = Validator::make($data, $rules);
        $this->assertFalse($validator->fails());

        // Test with wrong data.
        $data = ['post_code' => '72200'];
        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
    }

    /**
     * Test PostCode "without_dash" option.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     */
    public function testWithoutDashOption()
    {
        $rules = ['post_code' => 'post_code:without_dash'];

        // Test with correct data.
        $data = ['post_code' => '72200'];
        $validator = Validator::make($data, $rules);
        $this->assertFalse($validator->fails());

        // Test with wrong data.
        $data = ['post_code' => '72-200'];
        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
    }
}

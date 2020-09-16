<?php

namespace Tests\Unit;

use PacerIT\LaravelPolishValidationRules\Rules\PostCodeRule;

/**
 * Class PostCodeRuleTest.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
 * @since 2019-08-12
 */
class PostCodeRuleTest extends AbstractRuleTest
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
        $this->rule = new PostCodeRule();
    }

    /**
     * Test valid PostCode number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
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
     *
     * @since 2019-08-12
     */
    public function testNotValidPostCode()
    {
        $this->assertFalse($this->rule->passes('post_code', '7220'));
    }

    /**
     * Test null PostCode number.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 02/12/2019
     */
    public function testNullPostCode()
    {
        $this->assertFalse($this->rule->passes('post_code', null));
    }
}

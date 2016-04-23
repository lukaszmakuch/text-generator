<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class StaticTextGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testReturningTheGivenText()
    {
        $this->assertEquals(
            "abc",
            (new StaticTextGenerator("abc"))->getTextBasedOn("anything")
        );
    }
}

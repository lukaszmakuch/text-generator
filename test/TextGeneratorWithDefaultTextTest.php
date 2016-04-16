<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use lukaszmakuch\TextGenerator\Example\TextHoldingClass;
use lukaszmakuch\TextGenerator\Example\TextHoldingClassTextGenerator;
use PHPUnit_Framework_TestCase;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class TextGeneratorWithDefaultTextTest extends PHPUnit_Framework_TestCase
{
    private $textGenerator;

    protected function setUp()
    {
        $this->textGenerator = new TextGeneratorWithDefaultText(
            new TextHoldingClassTextGenerator(), 
            "default text"
        );
    }

    public function testDelegation()
    {
        $this->assertEquals(
            "abc",
            $this->textGenerator->getTextBasedOn(new TextHoldingClass("abc"))
        );
    }

    public function testDefaultTextIfUnsupportedInput()
    {
        $this->assertEquals(
            "default text",
            $this->textGenerator->getTextBasedOn(new \stdClass())
        );
    }
}

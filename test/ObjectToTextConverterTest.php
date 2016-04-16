<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use DateTime;
use lukaszmakuch\TextGenerator\Example\TextHoldingClass;
use lukaszmakuch\TextGenerator\Example\TextHoldingClassTextGenerator;
use lukaszmakuch\TextGenerator\Exception\UnableToGetText;
use PHPUnit_Framework_TestCase;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ObjectToTextConverterTest extends PHPUnit_Framework_TestCase
{
    private $textGenerator;
    
    protected function setUp()
    {
        $this->textGenerator = new TextHoldingClassTextGenerator();
    }

    public function testExceptionIfSomethingDifferentThanObject()
    {
        $this->setExpectedExceptionRegExp(
            UnableToGetText::class, 
            "@expected an object.*string was given@"
        );
        $this->textGenerator->getTextBasedOn("not an object");
    }

    public function testExceptionIfWrongObjectClass()
    {
        $this->setExpectedExceptionRegExp(
            UnableToGetText::class, 
            "@expected " . preg_quote(TextHoldingClass::class) . ".*DateTime was given@"
        );
        $this->textGenerator->getTextBasedOn(new DateTime());
    }

    public function testGeneratingTextBasedOnObjects()
    {
        $textValue = "abc";
        $inputObject = new TextHoldingClass($textValue);
        $this->assertEquals(
            $textValue, 
            $this->textGenerator->getTextBasedOn($inputObject)
        );
    }
}

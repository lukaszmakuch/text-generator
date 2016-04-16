<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use lukaszmakuch\TextGenerator\Exception\UnableToGetText;

class TextHoldingClass
{
    public $itsText;
    public function __construct($itsText) { $this->itsText = $itsText; }
}

class TextHoldingClassTextGenerator extends ObjectTextGenerator
{
    protected function getClassOfSupportedObjects()
    {
        return TextHoldingClass::class;
    }

    protected function getTextBasedOnObject($object)
    {
        /* @var $object TextHoldingClass */
        return $object->itsText;
    }
}

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ObjectTextGeneratorTest extends \PHPUnit_Framework_TestCase
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
        $this->textGenerator->getTextBasedOn(new \DateTime());
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

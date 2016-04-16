<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use DateTime;
use lukaszmakuch\TextGenerator\Exception\UnableToGetText;
use PHPUnit_Framework_TestCase;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ClassBasedTextGeneratorTest extends PHPUnit_Framework_TestCase
{
    private $textGenerator;
    
    protected function setUp()
    {
        $this->textGenerator = new ClassBasedTextGenerator();
    }

    public function testExceptionIfNotObject()
    {
        $this->setExpectedExceptionRegExp(
            UnableToGetText::class,
            "@only objects are supported@"
        );
        $this->textGenerator->getTextBasedOn("not an object");
    }
    
    public function testExceptionIfUnsupportedClass()
    {
        $this->setExpectedExceptionRegExp(
            UnableToGetText::class,
            "@DateTime is not supported@"
        );
        $this->textGenerator->getTextBasedOn(new DateTime());
    }
    
    public function testRegisteringRepresentationsOfClasses()
    {
        $this->textGenerator->addTextualRepresentationOf(
            DateTime::class, 
            "date"
        );
        $this->assertEquals(
            "date",
            $this->textGenerator->getTextBasedOn(new DateTime())
        );
    }
}

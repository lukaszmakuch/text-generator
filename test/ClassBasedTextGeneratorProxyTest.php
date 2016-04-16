<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use DateTime;
use lukaszmakuch\TextGenerator\ClassBasedTextGeneratorProxy;
use lukaszmakuch\TextGenerator\Example\TextHoldingClass;
use lukaszmakuch\TextGenerator\Example\TextHoldingClassTextGenerator;
use lukaszmakuch\TextGenerator\Exception\UnableToGetText;
use PHPUnit_Framework_TestCase;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ClassBasedTextGeneratorProxyTest extends PHPUnit_Framework_TestCase
{
    private $proxy;

    protected function setUp()
    {
        $this->proxy = new ClassBasedTextGeneratorProxy();
        $this->proxy->registerActualGenerator(
            TextHoldingClass::class, 
            new TextHoldingClassTextGenerator()
        );
    }

    public function testExceptionIfNoSuitableGeneratorFound()
    {
        $this->setExpectedExceptionRegExp(
            UnableToGetText::class, 
            "@no suitable generator found for DateTime@"
        );
        $this->proxy->getTextBasedOn(new DateTime());
    }

    public function testDelegation()
    {
        $this->assertEquals(
            "abc", 
            $this->proxy->getTextBasedOn(new TextHoldingClass("abc"))
        );
    }
}

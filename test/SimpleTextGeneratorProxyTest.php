<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use lukaszmakuch\TextGenerator\Exception\UnableToGetText;
use lukaszmakuch\TextGenerator\SimpleTextGeneratorProxy;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class SimpleTextGeneratorProxyTest extends \PHPUnit_Framework_TestCase
{
    private $proxy;
    
    protected function setUp()
    {
        $this->proxy = new SimpleTextGeneratorProxy();
    }
    
    public function testExceptionIfNoActualGeneratorIsSet()
    {
        $this->setExpectedException(
            UnableToGetText::class,
            "trying to use an empty simple proxy"
        );
        
        $this->proxy->getTextBasedOn("some input");
    }
    
    public function testDelegation()
    {
        $actualProxy = $this->getMock(TextGenerator::class);
        $actualProxy
            ->method("getTextBasedOn")
            ->will($this->returnValueMap([["input", "output"]]));

        $this->proxy->setActualGenerator($actualProxy);
        $this->assertEquals("output", $this->proxy->getTextBasedOn("input"));
    }
}

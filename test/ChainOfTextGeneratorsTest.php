<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use lukaszmakuch\TextGenerator\Exception\UnableToGetText;
use PHPUnit_Framework_TestCase;

/**
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ChainOfTextGeneratorsTest extends PHPUnit_Framework_TestCase
{
    private $chain;
    
    protected function setUp()
    {
        $this->chain = new ChainOfTextGenerators();
    }
    
    public function testExceptionIfEmptyChain()
    {
        $this->expectException(UnableToGetText::class);
        $this->expectExceptionMessageRegExp("@input not supported by any of the generators in the chain@");
        $this->chain->getTextBasedOn("not supported");
    }
    
    public function testUsingTheFirstGeneratorThatSupportsSomeInput()
    {
        $this->chain
            //fails
            ->add(new ClassBasedTextGenerator())
            //awalys returns "expected result"
            ->add(new TextGeneratorWithDefaultText(new SimpleTextGeneratorProxy(), "expected result"))
            //returns an empty string
            ->add(NULLTextGenerator::getInstance());
        $this->assertEquals(
            "expected result",
            $this->chain->getTextBasedOn("some input")
        );
    }
}
<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use lukaszmakuch\TextGenerator\Exception\UnableToGetText;

/**
 * Returns the result of the first text generator that is able to generate something.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ChainOfTextGenerators implements TextGenerator
{
    /**
     * @var TextGenerator[] 
     */
    private $generators = [];

    /**
     * Adds a new text generator to the end of this chain.
     * 
     * @param TextGenerator $generator
     * 
     * @return TextGenerator self
     */
    public function add(TextGenerator $generator)
    {
        $this->generators[] = $generator;
        return $this;
    }

    public function getTextBasedOn($input)
    {
        foreach ($this->generators as $singleGenerator) {
            try {
                return $singleGenerator->getTextBasedOn($input);
            } catch (UnableToGetText $e) {
                //that's ok that his generator wasn't able to get any text
                //we want to check if other ones can
            }
        }

        throw new UnableToGetText("input not supported by any of the generators in the chain");
    }
}

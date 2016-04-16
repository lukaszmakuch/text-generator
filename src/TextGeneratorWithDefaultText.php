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
 * Decorator that returns some default text if the decorated one doesn't support
 * the given input.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class TextGeneratorWithDefaultText implements TextGenerator
{
    /**
     * @var TextGenerator 
     */
    private $decoratedGenerator;
    
    /**
     * @var String
     */
    private $defaultText;

    /**
     * @param TextGenerator $decoratedGenerator
     * @param String $defaultText used when the given input is not supported
     */
    public function __construct(
        TextGenerator $decoratedGenerator,
        $defaultText
    ) {
        $this->decoratedGenerator = $decoratedGenerator;
        $this->defaultText = $defaultText;
    }
    public function getTextBasedOn($input)
    {
        try {
            return $this->decoratedGenerator->getTextBasedOn($input);
        } catch (UnableToGetText $e) {
            return $this->defaultText;
        }
    }
}

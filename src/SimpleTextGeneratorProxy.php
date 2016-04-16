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
 * Hides some actual implementation under the hood.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class SimpleTextGeneratorProxy implements TextGenerator
{
    /**
     * @var TextGenerator|null
     */
    private $actualGenerator = null;
    
    public function setActualGenerator(TextGenerator $generator)
    {
        $this->actualGenerator = $generator;
    }
    
    public function getTextBasedOn($input)
    {
        if (is_null($this->actualGenerator)) {
            throw new UnableToGetText("trying to use an empty simple proxy");
        }

        return $this->actualGenerator->getTextBasedOn($input);
    }
}

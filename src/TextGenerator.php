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
 * Converts some given input to text.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
interface TextGenerator
{
    /**
     * @param mixed $input
     * @return String
     * @throws UnableToGetText
     */
    public function getTextBasedOn($input);
}

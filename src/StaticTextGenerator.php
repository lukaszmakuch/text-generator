<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

/**
 * Always returns the same value.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class StaticTextGenerator implements TextGenerator
{
    /**
     * @var String
     */
    private $returnedText;
    
    /**
     * @param String $returnedText the text that is returned regardless what
     * is passed as the input
     */
    public function __construct($returnedText)
    {
        $this->returnedText = $returnedText;
    }
    
    public function getTextBasedOn($input)
    {
        return $this->returnedText;
    }

}

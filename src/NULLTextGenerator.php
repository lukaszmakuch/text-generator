<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

/**
 * A singleton that returns an empty string for any given input.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class NULLTextGenerator implements TextGenerator
{
    /**
     * @var TextGenerator 
     */
    private static $instance = null;

    /**
     * @return TextGenerator
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    public function getTextBasedOn($input)
    {
        return "";
    }
}

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
 * Template of a generator that converts an object to text.
 * 
 * Ensures that the given input is an object of a supported class.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
abstract class ObjectToTextConverter implements TextGenerator
{
    public function getTextBasedOn($input)
    {
        $this->throwExceptionIfUnsupported($input);
        return $this->getTextBasedOnObject($input);
    }
    
    /**
     * @return String class of supported objects
     */
    protected abstract function getClassOfSupportedObjects();
    
    /**
     * @param mixed $object object to translate
     * @return String
     * @throws UnableToGetText
     */
    protected abstract function getTextBasedOnObject($object);

    /**
     * @param mixed $input probably a supported object
     * @throws UnableToGetText
     */
    private function throwExceptionIfUnsupported($input)
    {
        if (!is_object($input)) { 
            throw new UnableToGetText(sprintf(
                "%s expected an object, but %s was given",
                __CLASS__,
                gettype($input)
            ));
        }

        $supportedClass = $this->getClassOfSupportedObjects();
        if (!($input instanceof $supportedClass)) {
            throw new UnableToGetText(sprintf(
                "%s expected %s, but %s was given",
                __CLASS__,
                $supportedClass,
                get_class($input)
            ));
        }
    }
}

<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator;

use lukaszmakuch\ClassBasedRegistry\ClassBasedRegistry;
use lukaszmakuch\ClassBasedRegistry\Exception\ValueNotFound;
use lukaszmakuch\TextGenerator\Exception\UnableToGetText;

/**
 * Takes into account nothing but the class of a given object.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ClassBasedTextGenerator implements TextGenerator
{
    /**
     * @var ClassBasedRegistry 
     */
    private $textualRepresentationOfClasses;

    public function __construct()
    {
        $this->textualRepresentationOfClasses = new ClassBasedRegistry();
    }

    /**
     * Adds a textual representation of every object of the given class.
     *
     * @param String $class
     * @param String $itsTextualRepresentation
     */
    public function addTextualRepresentationOf($class, $itsTextualRepresentation)
    {
        $this->textualRepresentationOfClasses->associateValueWithClasses(
            $itsTextualRepresentation,
            [$class]
        );
    }

    public function getTextBasedOn($input)
    {
        if (!is_object($input)) {
            throw new UnableToGetText("only objects are supported");
        }

        try {
            return $this->textualRepresentationOfClasses->fetchValueByObjects([$input]);
        } catch (ValueNotFound $e) {
            throw new UnableToGetText(sprintf(
                "%s is not supported",
                 get_class($input)
            ));
        }
    }
}

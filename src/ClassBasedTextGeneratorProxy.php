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
 * Delegates work based on the class of a given object.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class ClassBasedTextGeneratorProxy implements TextGenerator
{
    private $actualGenerators;
    
    public function __construct()
    {
        $this->actualGenerators = new ClassBasedRegistry();
    }
    
    /**
     * Adds support of the given class of objects by the given generator.
     * 
     * @param String $classOfSupportedObjects
     * @param TextGenerator $actualGenerator
     */
    public function registerActualGenerator(
        $classOfSupportedObjects, 
        TextGenerator $actualGenerator
    ) {
        $this->actualGenerators->associateValueWithClasses(
            $actualGenerator, 
            [$classOfSupportedObjects]
        );
    } 
    
    public function getTextBasedOn($input)
    {
        try {
            /* @var $actualGenerator TextGenerator */
            $actualGenerator = $this->actualGenerators->fetchValueByObjects([$input]);
            return $actualGenerator->getTextBasedOn($input);
        } catch (ValueNotFound $e) {
            throw new UnableToGetText(sprintf(
                "no suitable generator found for %s", 
                get_class($input)
            ));
        }
    }
}

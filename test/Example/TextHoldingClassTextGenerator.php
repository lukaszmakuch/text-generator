<?php

/**
 * This file is part of the TextGenerator library.
 *
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 * @license MIT http://opensource.org/licenses/MIT
 */

namespace lukaszmakuch\TextGenerator\Example;

use lukaszmakuch\TextGenerator\ObjectToTextConverter;

/**
 * Created for testing purposes.
 * 
 * @author Łukasz Makuch <kontakt@lukaszmakuch.pl>
 */
class TextHoldingClassTextGenerator extends ObjectToTextConverter
{
    protected function getClassOfSupportedObjects()
    {
        return TextHoldingClass::class;
    }

    protected function getTextBasedOnObject($object)
    {
        /* @var $object TextHoldingClass */
        return $object->itsText;
    }
}

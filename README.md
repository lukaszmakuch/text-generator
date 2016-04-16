[![travis](https://travis-ci.org/lukaszmakuch/text-generator.svg)](https://travis-ci.org/lukaszmakuch/text-generator)
# TextGenerator
Converts anything to text. Works like a _toString_ implementation, but outside the object.
## Brief description
For more details, check unit tests.
### TextGenerator
It's the base interface. It takes some input and returns a textual representation of it, or throws an exception if it's not supported.
```php
use lukaszmakuch\TextGenerator\TextGenerator;
use lukaszmakuch\TextGenerator\Exception\UnableToGetText;

/* @var $textGenerator TextGenerator */
try {
    echo $textGenerator->getTextBasedOn($anything);
} catch (UnableToGetText $e) {
    echo $e->getMessage();
}
```

### ClassBasedTextGenerator
Takes into account nothing but the class of a given object.
```php
use lukaszmakuch\TextGenerator\ClassBasedTextGenerator;

/* @var $textGenerator ClassBasedTextGenerator */
$textGenerator->addTextualRepresentationOf(
    \DateTime::class,
    "a DateTime object"
);
echo $textGenerator->getTextBasedOn(new \DateTime()); //"a DateTime object"
```

### ObjectToTextConverter
Template of a generator that converts an object to text.
```php
use lukaszmakuch\TextGenerator\ObjectToTextConverter;

class DateTimeTextPresenter extends ObjectToTextConverter
{
    protected function getClassOfSupportedObjects()
    {
        return \DateTime::class;
    }

    protected function getTextBasedOnObject($object)
    {
        /* @var $object \DateTime */
        return $object->format("It's " . $object->format("Y"));
    }
}

$textGenerator = new DateTimeTextPresenter();
echo $textGenerator->getTextBasedOn(new \DateTime("2016-01-01")); //"It's 2016"
```

### TextGeneratorWithDefaultText
Decorator that returns some default text if the decorated one doesn't support the given input.
```php
use lukaszmakuch\TextGenerator\TextGeneratorWithDefaultText;
use lukaszmakuch\TextGenerator\TextGenerator;

$textGenerator = new TextGeneratorWithDefaultText(
    /* @var $actualGenerator TextGenerator */
    $actualGenerator,
    "default text if the input is not supported"
);
```

### NULLTextGenerator
Returns an empty string for any given input.
```php
use lukaszmakuch\TextGenerator\NULLTextGenerator;

$textGenerator = NULLTextGenerator::getInstance();
$textGenerator->getTextBasedOn($anything); //an empty string
```

### SimpleTextGeneratorProxy
Hides some actual implementation under the hood. Useful when solving circular dependencies.
```php
use lukaszmakuch\TextGenerator\SimpleTextGeneratorProxy;
use lukaszmakuch\TextGenerator\TextGenerator;

/* @var $actualGenerator TextGenerator */
$textGenerator = new SimpleTextGeneratorProxy();
$textGenerator->setActualGenerator(actualGenerator)
```

### ClassBasedTextGeneratorProxy
Delegates work based on the class of a given object.
```php
use lukaszmakuch\TextGenerator\SimpleTextGeneratorProxy;

/* @var $dateTimeTextGenerator TextGenerator */
/* @var $someClassObjectsTextGenerator TextGenerator */
$textGenerator = new ClassBasedTextGeneratorProxy();
$textGenerator->registerActualGenerator(
    \DateTime::class,
    $dateTimeTextGenerator
);
$textGenerator->registerActualGenerator(
    SomeClass::class,
    $someClassObjectsTextGenerator
);
```

## Installation
Use [composer](https://getcomposer.org) to get the latest version:
```
$ composer require lukaszmakuch/text-generator
```

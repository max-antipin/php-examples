<?php

declare(strict_types=1);

namespace Example;

/**
 * Read-only and constant property $foo.
 * Every time we read the same value.
 */
class ReadOnlyPropertyDemo
{
    final public function __construct(
        public readonly string $foo
    ) {
    }
}

/**
 * Read-only but not constant property $foo.
 * Every time we read it, we get different values.
 */
class GetOnlyPropertyDemo
{
    private(set) int $counter = 0;

    final public function doNothing(): void
    {
        ++$this->counter;
    }
}

$obj = new ReadOnlyPropertyDemo('The Value');

echo $obj->foo, PHP_EOL;

// Error: Cannot access private property ReadOnlyPropertyDemo::$foo:
// $obj->foo = 'A brand new value';

$obj = new GetOnlyPropertyDemo;
$obj->doNothing();
$obj->doNothing();
$obj->doNothing();
echo "Did nothing $obj->counter times", PHP_EOL;

// Error: Cannot modify private(set) property Example\GetOnlyPropertyDemo::$counter from global scope:
// $obj->counter = 10;

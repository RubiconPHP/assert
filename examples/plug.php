<?php
namespace Rubicon\Assert;
use Rubicon\Assert\Extension\String;

$assert = require 'bootstrap.php';

class JsonExtension extends String
{
    public function setValue($value)
    {
        $this->value = json_decode($value);
    }

    public function getNamespace()
    {
        return 'json';
    }
}

class JsonProperty implements Constraint\ConstraintInterface
{
    public function evaluate($actual, $expected)
    {
        return property_exists($actual, $expected);
    }

    public function getMessage($actual, $expected)
    {
        return 'no property';
    }

}

$assert->register([
    'extensions' => [
        'invokables' => [
            'json' => JsonExtension::class
        ]
    ],
    'constraints' => [
        'invokables' => [
            'json.contains' => JsonProperty::class
        ]
    ]
]);

$assert
    ->json('{"name":"ronan"}')
    ->contains('name')
;
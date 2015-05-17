<?php
namespace Rubicon\Assert;
$assert = require 'bootstrap.php';

class JsonExtension extends Extension\AbstractExtension
{
    public function setValue($value)
    {
        $this->value = json_decode($value);
    }

    protected function getServiceName($service)
    {
        return 'json.' . $service;
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

$assert->extend([
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

$assert->json('{"name":"ronan"}')
    ->contains('name');
<?php

namespace Rubicon\Assert;

$assert = require 'bootstrap.php';

$assert->object($obj = new \SplMinHeap())

    ->is('positive conditions')
        ->objectOf(\SplMinHeap::class)
        ->childOf(\SplHeap::class)
        ->implementationOf(\Iterator::class)

    ->not('Negative conditions')
        ->instanceOf(\ArrayObject::class)
        ->beThrown()

    ->and('syntax sugar condition')
        ->satisfy(function($expected) {
            return $expected == new \stdClass();
        })
;
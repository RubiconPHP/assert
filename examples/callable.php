<?php
namespace Rubicon\Assert;
$assert = require 'bootstrap.php';

$assert
    ->that(function() {
        throw new \Exception;
    })
    ->shouldNot()
        ->returnValue('coucou')
    ->but()
        ->throwException('Exception')
;
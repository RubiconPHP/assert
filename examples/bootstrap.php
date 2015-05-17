<?php

use Rubicon\Assert\Asserter;
use Rubicon\Assert\Listener\ExceptionListener;

require dirname(__DIR__) . '/vendor/autoload.php';

$asserter = Asserter::getInstance();
$asserter->attach(new ExceptionListener());

return $asserter;
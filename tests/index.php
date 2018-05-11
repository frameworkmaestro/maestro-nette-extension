<?php

use Maestro\MaestroFactory;

$container = require __DIR__ . '/bootstrap.php';

$manager = $container->getByType(MaestroFactory::class);

// var_dump($manager);




<?php
require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

$configurator->setTempDirectory(__DIR__ . '/temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

$configurator->addConfig(__DIR__ . '/config.neon');

$container = $configurator->createContainer();

return $container;

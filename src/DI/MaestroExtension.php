<?php

namespace Maestro\DI;

use ArrayObject;
use Maestro\MaestroFactory;
use Nette\DI\CompilerExtension;

final class MaestroExtension extends CompilerExtension
{

    private $defaults = [
        'options' => [],
    ];

    public function loadConfiguration()
    {
        $this->validateConfig($this->defaults);
        $builder = $this->getContainerBuilder();
        $builder->addDefinition($this->prefix('maestro.factory'))
            ->setFactory(MaestroFactory::class, [$this->config]);
    }
}

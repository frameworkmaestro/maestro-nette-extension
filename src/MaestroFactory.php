<?php

namespace Maestro;

use Closure;
use Nette\DI\Container;

final class MaestroFactory
{

    /**
     * @var array
     */
    private $configuration;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param array $configuration
     * @param Container $container
     */
    public function __construct(array $configuration, Container $container)
    {
        $this->configuration = $configuration;
        $this->container = $container;
    }

    /**
     * @return SlimApp
     */
    public function create()
    {
        $manager = new Manager($this->configuration);

        $options = $this->getConfiguration($this->configuration['options']);

        return $manager;

    }

    /**
     * @param string $configurationCode
     * @return array
     */
    private function getConfiguration($configurationCode)
    {
        $configuration = $this->container->getParameters()[$configurationCode];

        if (!is_array($configuration)) {
            throw new \LogicException(sprintf('Missing %s configuration', $configurationCode));
        }

        //$this->validateConfiguration($configuration, $configurationCode, 'routes', 'array');
        //$this->validateConfiguration($configuration, $configurationCode, 'handlers', 'array');

        return $configuration;
    }

    /**
     * @param array $configuration
     * @param string $configurationCode
     * @param string $name
     * @param string $type
     */
    private function validateConfiguration(array $configuration, $configurationCode, $name, $type)
    {
        if (!isset($configuration[$name]) || gettype($configuration[$name]) !== $type) {
            throw new \LogicException(
                sprintf(
                    'Missing or empty %s.%s configuration (has to be %s, but is %s)',
                    $configurationCode,
                    $name,
                    $type,
                    gettype($configuration[$name])
                )
            );
        }
    }

}

<?php

namespace Reinfi\ModuleBridgeProvider\Test;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * @package Reinfi\ModuleBridgeProvider\Test
 */
class Module implements ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getConfig(): array
    {
        return require __DIR__ . '/resources/module.config.php';
    }
}
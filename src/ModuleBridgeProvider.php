<?php

namespace Reinfi\ModuleBridgeProvider;

use Zend\EventManager\EventManager;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Listener\DefaultListenerAggregate;
use Zend\ModuleManager\ModuleManager;
use Zend\Stdlib\ArrayUtils;

/**
 * @package Reinfi\ModuleBridgeProvider
 */
class ModuleBridgeProvider
{
    /**
     * @var array
     */
    private $modules = [];

    /**
     * @param array $modules
     */
    public function __construct(array $modules = [])
    {
        $this->modules = $modules;
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        $config = [];

        $moduleManager = $this->getModuleManager();

        foreach ($this->modules as $moduleName) {
            $module = $moduleManager->loadModule($moduleName);

            $config = ArrayUtils::merge(
                $config,
                $this->getModuleConfig($module)
            );
        }

        return $config;
    }

    /**
     * @return ModuleManager
     */
    private function getModuleManager(): ModuleManager
    {
        $eventManager = new EventManager();

        (new DefaultListenerAggregate)->attach($eventManager);

        return new ModuleManager($this->modules, $eventManager);
    }

    /**
     * @param object $module
     *
     * @return array
     */
    private function getModuleConfig($module): array
    {
        if (!$module instanceof ConfigProviderInterface
            && !is_callable([$module, 'getConfig'])
        ) {
            return [];
        }

        $moduleConfig = $module->getConfig();
        $moduleConfig['dependencies'] = ArrayUtils::merge(
            $moduleConfig['dependencies'] ?? [],
            $moduleConfig['service_manager'] ?? []
        );

        unset($moduleConfig['service_manager']);

        return $moduleConfig;
    }
}
<?php

namespace Reinfi\ModuleBridgeProvider\Test\Integration;

use PHPUnit\Framework\TestCase;
use Reinfi\ModuleBridgeProvider\ModuleBridgeProvider;
use Reinfi\ModuleBridgeProvider\Test\Module;

/**
 * @package Reinfi\ModuleBridgeProvider\Test\Integration
 */
class ModuleBridgeProviderTest extends TestCase
{
    /**
     * @test
     */
    public function itLoadsModuleConfig()
    {
        $provider = new ModuleBridgeProvider([ Module::class ]);

        $config = $provider();

        $this->assertInternalType(
            'array',
            $config,
            'Returned config should be of type array'
        );
    }

    /**
     * @test
     */
    public function itReplacesServiceManagerWithDependencies()
    {
        $provider = new ModuleBridgeProvider([ Module::class ]);

        $config = $provider();

        $this->assertArrayHasKey(
            'dependencies',
            $config,
            'config should have key dependencies'
        );

        $this->assertArrayNotHasKey(
            'service_manager',
            $config,
            'config should have not have key service_manager'
        );
    }

    /**
     * @test
     */
    public function itPreservesOtherConfigKeys()
    {
        $provider = new ModuleBridgeProvider([ Module::class ]);

        $config = $provider();

        $this->assertArrayHasKey(
            'other_config_key',
            $config,
            'config should have key other_config_key'
        );
    }
}
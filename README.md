[![Build Status](https://travis-ci.org/reinfi/zfe-module-bridge-provider.svg?branch=master)](https://travis-ci.org/reinfi/zfe-module-bridge-provider)
[![Coverage Status](https://coveralls.io/repos/github/reinfi/zfe-module-bridge-provider/badge.svg?branch=master)](https://coveralls.io/github/reinfi/zfe-module-bridge-provider?branch=master)

Add ZF2 or ZF3 modules to your Zend Expressive application via this bridge.

### Installation

1. Install with Composer: `composer require reinfi/zfe-module-bridge-provider`.
2. Use `ModuleBridgeProvider` in your  `config.php`:

```php
$aggregator = new ConfigAggregator([
    new \Reinfi\ModuleBridgeProvider\ModuleBridgeProvider(
        [
            YourModule::class,
            AnotherModule::class,
        ]
    ),
]);

return $aggregator->getMergedConfig();
```

### FAQ
Feel free to ask any questions or open own pull requests.
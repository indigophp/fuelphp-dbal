# FuelPHP DBAL

[![Packagist Version](https://img.shields.io/packagist/v/indigophp/fuelphp-dbal.svg?style=flat-square)](https://packagist.org/packages/indigophp/fuelphp-dbal)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/fuelphp-dbal.svg?style=flat-square)](https://packagist.org/packages/indigophp/fuelphp-dbal)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

**This package is a wrapper around [doctrine/dbal](https://github.com/doctrine/dbal) package.**


## Install

Via Composer

``` json
{
    "require": {
        "indigophp/fuelphp-dbal": "@stable"
    }
}
```


## Usage

Simply install this package to be able to use DBAL inside FuelPHP.


### Configuration

``` php
	'dbname'       => 'database'
	'host'         => 'localhost'
	'port'         => 1234
	'user'         => 'user',
	'password'     => 'secret',
	'driver'       => 'pdo_mysql',
	'driver_class' => 'MyNamespace\\MyDriverImpl', // the DBAL driverClass option
	'options'      => array( // the DBAL driverOptions option
	    'foo' => 'bar',
	),
	'path'             => '',
	'wrapper_class'    => 'MyDoctrineDbalConnectionWrapper', // the DBAL wrapperClass option
	'charset'          => 'UTF8',
	'profiling'        => true,
	'mapping_types'    => array(
	    'enum' => 'string',
	),
	'types' => array(
	    'custom' => 'MyCustomType',
	),
```


## Contributing

Please see [CONTRIBUTING](https://github.com/indigophp/fuel-dbal/blob/develop/CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [aspendigital](https://github.com/aspendigital/fuel-doctrine2)
- [All Contributors](https://github.com/indigophp/fuel-dbal/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/indigophp/fuel-dbal/blob/develop/LICENSE) for more information.

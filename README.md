# FuelPHP DBAL

[![Latest Version](https://img.shields.io/github/release/indigophp/fuelphp-dbal.svg?style=flat-square)](https://github.com/indigophp/fuelphp-dbal/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/indigophp/fuelphp-dbal.svg?style=flat-square)](https://packagist.org/packages/indigophp/fuelphp-dbal)

**This package is a wrapper around [doctrine/dbal](https://github.com/doctrine/dbal) package.**


## Install

Via Composer

``` bash
$ composer require indigophp/fuelphp-dbal
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

Please see [CONTRIBUTING](https://github.com/indigophp/fuelphp-dbal/blob/develop/CONTRIBUTING.md) for details.


## Credits

- [Márk Sági-Kazár](https://github.com/sagikazarmark)
- [aspendigital](https://github.com/aspendigital/fuel-doctrine2)
- [All Contributors](https://github.com/indigophp/fuelphp-dbal/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/indigophp/fuelphp-dbal/blob/develop/LICENSE) for more information.

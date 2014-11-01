<?php

/*
 * This file is part of the Fuel DBAL package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fuel\DBAL\Providers;

use Fuel\Common\Arr;
use Fuel\Dependency\ServiceProvider;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Types\Type;

/**
 * Provides DBAL service
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class FuelServiceProvider extends ServiceProvider
{
	/**
	 * {@inheritdoc}
	 */
	public $provides = ['dbal'];

	/**
	 * Default configuration values
	 *
	 * @var array
	 */
	protected $defaultConfig = [];

	/**
	 * Initializes DBAL
	 */
	private function initDbal()
	{
		$app = $this->getApp();

		$config = $app->getConfig();

		$config->load('db', true);
		$config->load('dbal', true);

		$this->defaultConfig = Arr::filterKeys($config->get('dbal', []), ['connections', 'types'], true);

		// Register types
		foreach ($config->get('dbal.types', []) as $type => $class)
		{
			Type::addType($type, $class);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function provide()
	{
		$this->initDbal();

		$this->register('dbal', function($context, array $config = [])
		{
			if ($context->isMultiton())
			{
				$instance = $context->getName() ?: '__default__';
			}
			else
			{
				$instance = '__default__';
			}

			$app = $this->getApp();

			$conf = $app->getConfig();

			// Legacy fuel db config support
			if ($db = $conf->get('db.' . $instance, []))
			{
				$db = $this->parseFuelConfig($db);
			}

			$config = array_merge($db, $this->defaultConfig, $conf->get('dbal.connections.'.$instance, []), $config);

			$conn = DriverManager::getConnection($config);

			// Register mapping types
			if (isset($config['mapping_types']))
			{
				$platform = $conn->getDatabasePlatform();

				foreach ($config['mapping_types'] as $dbType => $doctrineType)
				{
					$platform->registerDoctrineTypeMapping($dbType, $doctrineType);
				}
			}

			return $conn;
		});
	}

	/**
	 * Parses Fuel db config to DBAL compatible configuration
	 *
	 * @param array $config
	 *
	 * @return array
	 */
	public function parseFuelConfig(array $config)
	{
		$params = array();

		$params['driver'] = $config['type'];

		if ($params['driver'] === 'pdo')
		{
			list($type, $dsn) = explode(':', $config['connection']['dsn'], 2);

			$params['driver'] .= '_' . $type;

			$dsn = explode(';', $dsn);

			foreach ($dsn as $d)
			{
				list($k, $v) = explode('=', $d);

				$params[$k] = $v;
			}
		}
		else
		{
			$params['dbname'] = $config['connection']['database'];
			$params['host'] = $config['connection']['hostname'];
			$params['port'] = Arr::get($config, 'connection.port');
		}

		$params['user'] = Arr::get($config, 'connection.username');
		$params['password'] = Arr::get($config, 'connection.password');
		$params['charset'] = Arr::get($config, 'charset');

		return $params;
	}

	/**
	 * Returns the current application
	 *
	 * @return \Fuel\Foundation\Application
	 */
	private function getApp()
	{
		$stack = $this->resolve('requeststack');

		if ($request = $stack->top())
		{
			$app = $request->getApplication();
		}
		else
		{
			$app = $this->resolve('application::__main');
		}

		return $app;
	}
}

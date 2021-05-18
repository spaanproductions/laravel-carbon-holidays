<?php

namespace SpaanProductions\LaravelCarbonHolidays\Tests;

use SpaanProductions\LaravelCarbonHolidays\LaravelCarbonHolidaysServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
	protected function getPackageProviders($app)
	{
		return [
			LaravelCarbonHolidaysServiceProvider::class,
		];
	}
}

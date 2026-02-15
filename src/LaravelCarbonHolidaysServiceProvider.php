<?php

namespace SpaanProductions\LaravelCarbonHolidays;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\ServiceProvider;

class LaravelCarbonHolidaysServiceProvider extends ServiceProvider
{
	/** Bootstrap the application services. */
	public function boot(): void
	{
		$this->publishes([__DIR__.'/../config/holidays.php' => config_path('holidays.php')], 'config');
		$this->publishes([__DIR__.'/../config/holidays.php' => config_path('holidays.php')], 'laravel-carbon-holidays');

		$holidaysConfig = config('holidays', []);
		Carbon::mixin(new LaravelCarbonHolidays($holidaysConfig));
		CarbonImmutable::mixin(new LaravelCarbonHolidays($holidaysConfig));
	}

	/** Register the application services. */
	public function register(): void
	{
		// Merge package config with app config
		$this->mergeConfigFrom(
			__DIR__.'/../config/holidays.php',
			'holidays'
		);
	}
}

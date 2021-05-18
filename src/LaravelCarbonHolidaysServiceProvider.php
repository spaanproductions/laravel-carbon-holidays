<?php

namespace SpaanProductions\LaravelCarbonHolidays;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class LaravelCarbonHolidaysServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 */
	public function boot()
	{
		Carbon::mixin(new LaravelCarbonHolidays);
	}

	/**
	 * Register the application services.
	 */
	public function register()
	{
		//
	}
}

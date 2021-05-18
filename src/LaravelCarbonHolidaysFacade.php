<?php

namespace SpaanProductions\LaravelCarbonHolidays;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SpaanProductions\LaravelCarbonHolidays\Skeleton\SkeletonClass
 */
class LaravelCarbonHolidaysFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-carbon-holidays';
    }
}

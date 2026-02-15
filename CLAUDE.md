# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This Laravel package extends Carbon/CarbonImmutable with an `isHoliday()` method to check if a date is a Dutch holiday. It uses Carbon's mixin feature to add this functionality.

## Testing

```bash
# Run all tests
composer test
# or
vendor/bin/phpunit

# Run tests with coverage
composer test-coverage
```

Tests are located in `tests/Unit/` and use Orchestra Testbench for Laravel package testing.

## Architecture

**Core Components:**

- `LaravelCarbonHolidays.php` - Defines the `isHoliday()` method as a closure that checks against Dutch holidays
- `LaravelCarbonHolidaysServiceProvider.php` - Registers the mixin with both `Carbon` and `CarbonImmutable` classes during boot

**How it works:**

1. The ServiceProvider's `boot()` method calls `Carbon::mixin()` and `CarbonImmutable::mixin()` with an instance of `LaravelCarbonHolidays`
2. The `isHoliday()` method returns a closure that becomes available on all Carbon instances
3. Inside the closure, `$this` refers to the Carbon instance being checked
4. The method calculates all Dutch holidays for the instance's year and compares dates using `isSameDay()`

**Dutch Holidays Checked:**

- New Year (01/01)
- Good Friday (Easter - 2 days)
- Easter (calculated using PHP's `easter_days()`)
- Easter Monday (Easter + 1)
- King's Day (04/27, or 04/26 if 04/27 is Sunday)
- Liberation Day (05/05)
- Ascension Day (Easter + 39)
- Pentecost/Whitsun (Easter + 49)
- Pentecost Monday (Easter + 50)
- Christmas (25/12)
- Boxing Day (26/12)

**Important:** This package checks if a date *is* a holiday, not whether it's a mandatory free day in the Netherlands.

## Dependencies

- PHP: ^8.0|^8.1|^8.2|^8.3|^8.4
- Laravel: ^10.0|^11.0|^12.0
- Carbon: ^2.0|^3.0
- ext-calendar (required for `easter_days()` function)
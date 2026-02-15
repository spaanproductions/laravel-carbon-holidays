---
name: laravel-carbon-holidays
description: Reference for Laravel Carbon Holidays package. Use when working with Dutch holiday checking, Carbon date validation, holiday detection in this package, or when users ask about available holiday methods or configuration.
---

# Laravel Carbon Holidays - Method Reference

This Laravel package extends Carbon and CarbonImmutable with Dutch holiday checking functionality through a powerful mixin system.

## Package Overview

**What it does:**
- Adds holiday-checking methods to both `Carbon` and `CarbonImmutable` instances
- Supports 11 official Dutch holidays
- Provides methods in English, Dutch, and alternative aliases (26 total methods)
- Configurable - enable/disable holidays individually
- **Important:** Checks if a date **IS** a holiday, not whether it's a mandatory free day in the Netherlands

**Supports:** Carbon ^2.0|^3.0, Laravel ^10.0|^11.0|^12.0, PHP ^8.0+

## Available Methods

### General Holiday Check

**`isHoliday()`** - Checks if the date is any enabled holiday
- Respects configuration in `config/holidays.php`
- Returns `true` if the date matches any enabled holiday
- Returns `false` for disabled holidays or non-holidays

### Individual Holiday Methods (11 Holidays)

These methods always check the actual date, regardless of configuration:

#### English Methods (Primary)

1. **`isNewYear()`** - January 1
2. **`isGoodFriday()`** - Easter Sunday minus 2 days
3. **`isEasterSunday()`** - Calculated using `easter_days()`
4. **`isEasterMonday()`** - Easter Sunday plus 1 day
5. **`isKingsDay()`** - April 27 (or April 26 if April 27 is Sunday)
6. **`isLiberationDay()`** - May 5
7. **`isAscensionDay()`** - Easter Sunday plus 39 days
8. **`isPentecost()`** - Easter Sunday plus 49 days (Whitsunday)
9. **`isPentecostMonday()`** - Easter Sunday plus 50 days (Whit Monday)
10. **`isChristmasDay()`** - December 25
11. **`isBoxingDay()`** - December 26

#### Dutch Method Aliases

All English methods have Dutch equivalents:

- **`isNieuwjaarsdag()`** - New Year's Day
- **`isGoedeVrijdag()`** - Good Friday
- **`isPaaszondag()`** - Easter Sunday
- **`isPaasmaandag()`** - Easter Monday
- **`isKoningsdag()`** - King's Day
- **`isBevrijdingsdag()`** - Liberation Day
- **`isHemelvaart()`** or **`isHemelvaartsdag()`** - Ascension Day
- **`isPinksterzondag()`** - Pentecost/Whitsunday
- **`isPinkstermaandag()`** - Pentecost Monday
- **`isEersteKerstdag()`** - Christmas Day
- **`isTweedeKerstdag()`** - Boxing Day

#### Additional Aliases

- **`isWhitsunday()`** - Alias for `isPentecost()`
- **`isWhitMonday()`** - Alias for `isPentecostMonday()`

### Helper Method

**`isLiberationDayYear()`** - Checks if the year qualifies for Liberation Day
- Returns `true` for years divisible by 5 (2020, 2025, 2030, etc.)
- Used when Liberation Day is set to `'once-every-5-years'` mode

## Dutch Holidays Reference

| Holiday          | English               | Dutch                 | Date Calculation          | Example 2021 |
|------------------|-----------------------|-----------------------|---------------------------|--------------|
| New Year's Day   | `isNewYear()`         | `isNieuwjaarsdag()`   | January 1                 | Jan 1        |
| Good Friday      | `isGoodFriday()`      | `isGoedeVrijdag()`    | Easter - 2 days           | Apr 2        |
| Easter Sunday    | `isEasterSunday()`    | `isPaaszondag()`      | `easter_days()`           | Apr 4        |
| Easter Monday    | `isEasterMonday()`    | `isPaasmaandag()`     | Easter + 1 day            | Apr 5        |
| King's Day       | `isKingsDay()`        | `isKoningsdag()`      | Apr 27 (or Apr 26 if Sun) | Apr 27       |
| Liberation Day   | `isLiberationDay()`   | `isBevrijdingsdag()`  | May 5                     | May 5        |
| Ascension Day    | `isAscensionDay()`    | `isHemelvaart()`      | Easter + 39 days          | May 13       |
| Pentecost        | `isPentecost()`       | `isPinksterzondag()`  | Easter + 49 days          | May 23       |
| Pentecost Monday | `isPentecostMonday()` | `isPinkstermaandag()` | Easter + 50 days          | May 24       |
| Christmas Day    | `isChristmasDay()`    | `isEersteKerstdag()`  | December 25               | Dec 25       |
| Boxing Day       | `isBoxingDay()`       | `isTweedeKerstdag()`  | December 26               | Dec 26       |

### Special Cases

**King's Day:** If April 27 falls on Sunday, King's Day is celebrated on April 26 (Saturday).
```php
Carbon::parse('2025-04-27')->isKingsDay(); // false (it's Sunday in 2025)
Carbon::parse('2025-04-26')->isKingsDay(); // true (moved to Saturday)
```

## Configuration

Publish the config file:
```bash
php artisan vendor:publish --tag="holidays-config"
```

Location: `config/holidays.php`

### Individual Holiday Control

Each holiday can be enabled/disabled:

```php
return [
    'new_year' => true,
    'good_friday' => true,
    'easter_sunday' => true,
    'easter_monday' => true,
    'kings_day' => true,
    'liberation_day' => true,  // See special modes below
    'ascension_day' => true,
    'pentecost' => true,
    'pentecost_monday' => true,
    'christmas_day' => true,
    'boxing_day' => true,
];
```

### Liberation Day Special Modes

Liberation Day has three possible values:

- **`true`** - Always considered a holiday (default)
- **`false`** - Never considered a holiday
- **`'once-every-5-years'`** - Only in years divisible by 5 (2020, 2025, 2030, etc.)

```php
'liberation_day' => 'once-every-5-years',
```

## Usage Examples

### Basic Holiday Checking

```php
use Carbon\Carbon;

// Check any holiday
Carbon::parse('2021-12-25')->isHoliday(); // true

// Check specific holiday
Carbon::parse('2021-12-25')->isChristmasDay(); // true
Carbon::parse('2021-12-26')->isBoxingDay(); // true
Carbon::parse('2021-04-27')->isKingsDay(); // true
```

### Using Dutch Methods

```php
Carbon::parse('2021-12-25')->isEersteKerstdag(); // true
Carbon::parse('2021-04-27')->isKoningsdag(); // true
Carbon::parse('2021-05-05')->isBevrijdingsdag(); // true
```

### King's Day Special Case

```php
// Normal years (April 27 not on Sunday)
Carbon::parse('2021-04-27')->isKingsDay(); // true

// 2025 - April 27 is Sunday, moved to Saturday
Carbon::parse('2025-04-27')->isKingsDay(); // false
Carbon::parse('2025-04-26')->isKingsDay(); // true (moved)
```

### CarbonImmutable Support

```php
use Carbon\CarbonImmutable;

CarbonImmutable::parse('2021-12-25')->isHoliday(); // true
CarbonImmutable::parse('2021-12-25')->isChristmasDay(); // true
CarbonImmutable::parse('2025-04-26')->isKingsDay(); // true
```

### Easter-Based Holidays

```php
// 2021 Easter was April 4
Carbon::parse('2021-04-02')->isGoodFriday(); // true (Easter - 2)
Carbon::parse('2021-04-04')->isEasterSunday(); // true
Carbon::parse('2021-04-05')->isEasterMonday(); // true (Easter + 1)
Carbon::parse('2021-05-13')->isAscensionDay(); // true (Easter + 39)
Carbon::parse('2021-05-23')->isPentecost(); // true (Easter + 49)
Carbon::parse('2021-05-24')->isPentecostMonday(); // true (Easter + 50)
```

### Alternative Aliases

```php
// Pentecost alternatives
Carbon::parse('2021-05-23')->isWhitsunday(); // true
Carbon::parse('2021-05-24')->isWhitMonday(); // true

// Ascension alternative
Carbon::parse('2021-05-13')->isHemelvaartsdag(); // true
```

## Configuration vs Individual Methods

**Critical distinction:** The `isHoliday()` method respects configuration, but individual holiday methods always check the actual date.

### Example

```php
// config/holidays.php
return [
    'new_year' => false,  // Disabled
    // ... other holidays
];
```

```php
$newYear = Carbon::parse('2021-01-01');

// isHoliday() respects config - returns false because new_year is disabled
$newYear->isHoliday(); // false

// Individual method always checks actual date - returns true
$newYear->isNewYear(); // true
```

**When to use which:**
- Use **`isHoliday()`** when you want to respect your application's holiday configuration
- Use **individual methods** when you need to check if a date factually IS that holiday, regardless of config

## Dependencies

**Required PHP Extension:** `ext-calendar`

This extension is required for the `easter_days()` function used to calculate Easter and Easter-based holidays (Good Friday, Easter Monday, Ascension Day, Pentecost).

## Installation

```bash
composer require spaan-productions/laravel-carbon-holidays
```

The package auto-registers via Laravel's package discovery.

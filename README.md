# Carbon isHoliday() function to check if the current date is a Holiday

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spaanproductions/laravel-carbon-holidays.svg?style=flat-square)](https://packagist.org/packages/spaanproductions/laravel-carbon-holidays)
[![Total Downloads](https://img.shields.io/packagist/dt/spaanproductions/laravel-carbon-holidays.svg?style=flat-square)](https://packagist.org/packages/spaanproductions/laravel-carbon-holidays)
![GitHub Actions](https://github.com/spaanproductions/laravel-carbon-holidays/actions/workflows/main.yml/badge.svg)

This package can be used to add the isHoliday() function to [Carbon](https://github.com/briannesbitt/carbon). 
This only checks the **Dutch** holidays at the moment. We will only check if it's a holiday, not if it's a mandatory free day. 

## Installation

You can install the package via composer:

```bash
composer require spaanproductions/laravel-carbon-holidays
```

It will auto discover in Laravel. 

## Usage

### Check if any holiday

```php
use Carbon\Carbon;

$date = Carbon::parse('2021-12-25');
$date->isHoliday(); // true

$date = Carbon::parse('2021-06-15');
$date->isHoliday(); // false
```

### Check specific holidays

You can check for individual holidays using either English or Dutch method names:

```php
// English method names
$date = Carbon::parse('2021-12-25');
$date->isChristmasDay(); // true

$date = Carbon::parse('2021-04-27');
$date->isKingsDay(); // true

$date = Carbon::parse('2021-01-01');
$date->isNewYear(); // true

// Dutch method names
$date = Carbon::parse('2021-12-25');
$date->isEersteKerstdag(); // true

$date = Carbon::parse('2021-04-27');
$date->isKoningsdag(); // true

$date = Carbon::parse('2021-01-01');
$date->isNieuwjaarsdag(); // true
```

### Available Methods

All methods work with both `Carbon` and `CarbonImmutable` instances.

| Holiday (English) | Holiday (Dutch) | English Method | Dutch Method | Date |
|-------------------|-----------------|----------------|--------------|------|
| New Year's Day | Nieuwjaarsdag | `isNewYear()` | `isNieuwjaarsdag()` | January 1 |
| Good Friday | Goede Vrijdag | `isGoodFriday()` | `isGoedeVrijdag()` | Friday before Easter |
| Easter Sunday | Paaszondag | `isEasterSunday()` | `isPaaszondag()` | Calculated |
| Easter Monday | Paasmaandag | `isEasterMonday()` | `isPaasmaandag()` | Monday after Easter |
| King's Day | Koningsdag | `isKingsDay()` | `isKoningsdag()` | April 27* |
| Liberation Day | Bevrijdingsdag | `isLiberationDay()` | `isBevrijdingsdag()` | May 5 |
| Ascension Day | Hemelvaart | `isAscensionDay()` | `isHemelvaart()`† | Thursday, Easter + 39 days |
| Pentecost | Pinksterzondag | `isPentecost()`‡ | `isPinksterzondag()` | Sunday, Easter + 49 days |
| Pentecost Monday | Pinkstermaandag | `isPentecostMonday()`‡ | `isPinkstermaandag()` | Monday, Easter + 50 days |
| Christmas Day | Eerste Kerstdag | `isChristmasDay()` | `isEersteKerstdag()` | December 25 |
| Boxing Day | Tweede Kerstdag | `isBoxingDay()` | `isTweedeKerstdag()` | December 26 |

\* King's Day is April 26 when April 27 falls on a Sunday
† Also available as `isHemelvaartsdag()`
‡ Aliases available: `isWhitsunday()` and `isWhitMonday()`

### Practical Examples

#### King's Day / Koningsdag

```php
// Normal King's Day (April 27)
Carbon::parse('2021-04-27')->isKingsDay(); // true

// When April 27 is Sunday, celebrated on April 26
Carbon::parse('2025-04-26')->isKoningsdag(); // true
Carbon::parse('2025-04-27')->isKoningsdag(); // false
```

#### Easter-related holidays

```php
// Easter Sunday 2021
Carbon::parse('2021-04-04')->isEasterSunday(); // true
Carbon::parse('2021-04-04')->isPaaszondag(); // true

// Good Friday (the Friday before Easter)
Carbon::parse('2021-04-02')->isGoodFriday(); // true
Carbon::parse('2021-04-02')->isGoedeVrijdag(); // true

// Ascension Day (Thursday, 39 days after Easter)
Carbon::parse('2021-05-13')->isAscensionDay(); // true
Carbon::parse('2021-05-13')->isHemelvaart(); // true

// Pentecost (Sunday, 49 days after Easter)
Carbon::parse('2021-05-23')->isPentecost(); // true
Carbon::parse('2021-05-23')->isWhitsunday(); // true (alias)
Carbon::parse('2021-05-23')->isPinksterzondag(); // true (Dutch)
```

#### Working with CarbonImmutable

```php
use Carbon\CarbonImmutable;

$date = CarbonImmutable::parse('2021-12-25');
$date->isChristmasDay(); // true
$date->isEersteKerstdag(); // true
```

## Configuration

### Publishing the Config

You can publish the configuration file to customize which holidays are recognized:

```bash
php artisan vendor:publish --tag="laravel-carbon-holidays"
```

This creates `config/holidays.php` in your application.

### Configuration Options

Each holiday can be enabled (`true`) or disabled (`false`):

```php
return [
    'new_year' => true,
    'good_friday' => true,
    'easter_sunday' => true,
    'easter_monday' => true,
    'kings_day' => true,
    'liberation_day' => true,
    'ascension_day' => true,
    'pentecost' => true,
    'pentecost_monday' => true,
    'christmas_day' => true,
    'boxing_day' => true,
];
```

### Liberation Day Special Options

Liberation Day supports three configuration modes:

```php
// Always a holiday (default)
'liberation_day' => true,

// Never a holiday
'liberation_day' => false,

// Only a holiday once every 5 years (2020, 2025, 2030, etc.)
'liberation_day' => 'once-every-5-years',
```

Historically, Liberation Day in the Netherlands was only a public holiday once every 5 years. The `'once-every-5-years'` option implements this by checking if the year is divisible by 5.

### Important Notes

- **Configuration only affects `isHoliday()`** - The general `isHoliday()` method respects your configuration
- **Individual methods always work** - Methods like `isNewYear()`, `isChristmasDay()`, etc. check the actual date regardless of configuration
- **Example:**

```php
// With 'good_friday' => false in config
$date = Carbon::parse('2021-04-02');

$date->isHoliday();     // false (respects config - Good Friday disabled)
$date->isGoodFriday();  // true (checks the actual date - it IS Good Friday)
```

This allows you to:
- Control which holidays `isHoliday()` recognizes for your application
- Still use individual methods to check if a date matches a specific holiday

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email info@spaanproductions.nl instead of using the issue tracker.

## Credits

-   [Spaan Productions](https://github.com/spaanproductions)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

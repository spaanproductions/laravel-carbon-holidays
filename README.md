# Carbon isHoliday() function to check if the current date is a Holiday

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spaanproductions/laravel-carbon-holidays.svg?style=flat-square)](https://packagist.org/packages/spaanproductions/laravel-carbon-holidays)
[![Total Downloads](https://img.shields.io/packagist/dt/spaanproductions/laravel-carbon-holidays.svg?style=flat-square)](https://packagist.org/packages/spaanproductions/laravel-carbon-holidays)
![GitHub Actions](https://github.com/spaanproductions/laravel-carbon-holidays/actions/workflows/main.yml/badge.svg)

This package can be used to add the isHoliday() function to carbon. 
This only checks the **Dutch** holidays at the moment.

## Installation

You can install the package via composer:

```bash
composer require spaanproductions/laravel-carbon-holidays
```

It will auto discover in Laravel. 

## Usage

```php
use \Carbon\Carbon;

// NewYear
$date = Carbon::createFromDate(2021, 01, 01);
$date->isHoliday(); // true
```

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

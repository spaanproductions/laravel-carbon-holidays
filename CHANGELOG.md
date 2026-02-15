# Changelog

All notable changes to `laravel-carbon-holidays` will be documented in this file

## 3.0.6 - 2026-02-15

- Add configurable holidays with individual check methods
  - Individual methods for each holiday in English and Dutch (e.g., `isNewYear()`, `isKingsDay()`)
  - Configuration system to enable/disable specific holidays via `config/holidays.php`
  - Liberation Day supports 'always', 'never', or 'once-every-5-years' modes
- PHP 8.5 support added to CI workflow
- Add Claude Skill file for package documentation
- Enhanced documentation and test coverage

## 3.0.5 - 2025-06-16

- Support CarbonImmutable

## 3.0.4 - 2025-04-07

- Laravel 12.x support
- PHP 8.4 support
- Fix testcase

## 3.0.3 - 2024-06-04

- Update actions/checkout to v4

## 3.0.2 - 2024-06-04

- Laravel 11.x support

## 3.0.1 - 2023-12-15

- PHP 8.2 support

## 3.0.0 - 2023-06-27

- Remove Laravel 9.x support
- Remove PHP 8.0.x support
- Add Laravel 10.x support
- Add PHP 8.1.x support

## 2.0.2 - 2025-06-16

- CarbonImmutable support

## 2.0.1 - 2022-07-21

- Drop Facade

## 2.0.0 - 2022-02-14

- Drop PHP 7.x support
- Add Laravel 9.x support

## 1.0.1 - 2021-05-18

- Goede Vrijdag toegevoegd
- Bevrijdingsdag (5 mei) is altijd een feestdag (niet altijd vrij)

## 1.0.0 - 2021-05-18

- initial release

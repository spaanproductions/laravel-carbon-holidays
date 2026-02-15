<?php

namespace SpaanProductions\LaravelCarbonHolidays;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

class LaravelCarbonHolidays
{
	protected array $config;

	public function __construct(array $config = [])
	{
		// Default all holidays to enabled if not specified
		$this->config = array_merge([
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
		], $config);
	}

	// English Methods (Primary)

	public function isNewYear(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$newYear = Carbon::createFromDate($this->year, 01, 01);
			return $this->isSameDay($newYear);
		};
	}

	public function isGoodFriday(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$easter = Carbon::createFromDate($this->year, 03, 21)->addDays(easter_days($this->year));
			$goodFriday = $easter->clone()->subDays(2);
			return $this->isSameDay($goodFriday);
		};
	}

	public function isEasterSunday(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$easter = Carbon::createFromDate($this->year, 03, 21)->addDays(easter_days($this->year));
			return $this->isSameDay($easter);
		};
	}

	public function isEasterMonday(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$easter = Carbon::createFromDate($this->year, 03, 21)->addDays(easter_days($this->year));
			$easterMonday = $easter->clone()->addDay();
			return $this->isSameDay($easterMonday);
		};
	}

	public function isKingsDay(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$kingsDay = Carbon::createFromDate($this->year, 04, 27);
			if ($kingsDay->isSunday()) {
				$kingsDay->subDay();
			}
			return $this->isSameDay($kingsDay);
		};
	}

	public function isLiberationDay(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$liberationDay = Carbon::createFromDate($this->year, 05, 05);
			return $this->isSameDay($liberationDay);
		};
	}

	public function isLiberationDayYear(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			// Liberation Day is celebrated every 5 years: 1945, 1950, 1955... 2020, 2025, 2030
			// Years divisible by 5
			return $this->year % 5 === 0;
		};
	}

	public function isAscensionDay(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$easter = Carbon::createFromDate($this->year, 03, 21)->addDays(easter_days($this->year));
			$ascension = $easter->clone()->addDays(39);
			return $this->isSameDay($ascension);
		};
	}

	public function isPentecost(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$easter = Carbon::createFromDate($this->year, 03, 21)->addDays(easter_days($this->year));
			$pentecost = $easter->clone()->addDays(49);
			return $this->isSameDay($pentecost);
		};
	}

	public function isPentecostMonday(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$easter = Carbon::createFromDate($this->year, 03, 21)->addDays(easter_days($this->year));
			$pentecostMonday = $easter->clone()->addDays(50);
			return $this->isSameDay($pentecostMonday);
		};
	}

	public function isChristmasDay(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$christmas = Carbon::createFromDate($this->year, 12, 25);
			return $this->isSameDay($christmas);
		};
	}

	public function isBoxingDay(): \Closure
	{
		return function (): bool {
			/** @var Carbon|CarbonImmutable $this */
			$boxingDay = Carbon::createFromDate($this->year, 12, 26);
			return $this->isSameDay($boxingDay);
		};
	}

	// Dutch Methods (Aliases)

	public function isNieuwjaarsdag(): \Closure
	{
		return $this->isNewYear();
	}

	public function isGoedeVrijdag(): \Closure
	{
		return $this->isGoodFriday();
	}

	public function isPaaszondag(): \Closure
	{
		return $this->isEasterSunday();
	}

	public function isPaasmaandag(): \Closure
	{
		return $this->isEasterMonday();
	}

	public function isKoningsdag(): \Closure
	{
		return $this->isKingsDay();
	}

	public function isBevrijdingsdag(): \Closure
	{
		return $this->isLiberationDay();
	}

	public function isHemelvaart(): \Closure
	{
		return $this->isAscensionDay();
	}

	public function isPinksterzondag(): \Closure
	{
		return $this->isPentecost();
	}

	public function isPinkstermaandag(): \Closure
	{
		return $this->isPentecostMonday();
	}

	public function isEersteKerstdag(): \Closure
	{
		return $this->isChristmasDay();
	}

	public function isTweedeKerstdag(): \Closure
	{
		return $this->isBoxingDay();
	}

	// Additional Aliases

	public function isWhitsunday(): \Closure
	{
		return $this->isPentecost();
	}

	public function isWhitMonday(): \Closure
	{
		return $this->isPentecostMonday();
	}

	public function isHemelvaartsdag(): \Closure
	{
		return $this->isHemelvaart();
	}

	// General Holiday Check (Refactored)

	public function isHoliday(): \Closure
	{
		$config = $this->config; // Capture config for closure

		return function () use ($config) {
			/** @var Carbon|CarbonImmutable $this */

			return match (true) {
				$this->isNewYear() => ($config['new_year'] ?? true),
				$this->isGoodFriday() => ($config['good_friday'] ?? true),
				$this->isEasterSunday() => ($config['easter_sunday'] ?? true),
				$this->isEasterMonday() => ($config['easter_monday'] ?? true),
				$this->isKingsDay() => ($config['kings_day'] ?? true),
				$this->isLiberationDay() && $this->isLiberationDayYear() => ($config['liberation_day'] ?? true) === 'once-every-5-years' || ($config['liberation_day'] ?? true) === true,
				$this->isLiberationDay() => ($config['liberation_day'] ?? true) === true,
				$this->isAscensionDay() => ($config['ascension_day'] ?? true),
				$this->isPentecost() => ($config['pentecost'] ?? true),
				$this->isPentecostMonday() => ($config['pentecost_monday'] ?? true),
				$this->isChristmasDay() => ($config['christmas_day'] ?? true),
				$this->isBoxingDay() => ($config['boxing_day'] ?? true),
				default => false,
			};
		};
	}
}

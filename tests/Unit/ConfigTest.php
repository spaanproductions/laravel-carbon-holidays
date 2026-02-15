<?php

namespace SpaanProductions\LaravelCarbonHolidays\Tests\Unit;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\Attributes\Test;
use SpaanProductions\LaravelCarbonHolidays\LaravelCarbonHolidays;
use SpaanProductions\LaravelCarbonHolidays\Tests\TestCase;

class ConfigTest extends TestCase
{
	/**
	 * Re-register the mixin with the current config.
	 * This is needed because the mixin is registered once during boot,
	 * so changing config requires re-registering the mixin.
	 */
	protected function refreshMixin(): void
	{
		$holidaysConfig = config('holidays', []);
		Carbon::mixin(new LaravelCarbonHolidays($holidaysConfig));
		CarbonImmutable::mixin(new LaravelCarbonHolidays($holidaysConfig));
	}
	#[Test]
	public function default_config_enables_all_holidays(): void
	{
		$this->assertTrue(Carbon::parse('2021-12-25')->isHoliday());
		$this->assertTrue(Carbon::parse('2021-05-05')->isHoliday());
	}

	#[Test]
	public function can_disable_individual_holidays(): void
	{
		config(['holidays.christmas_day' => false]);
		$this->refreshMixin();

		$christmas = Carbon::parse('2021-12-25');
		$this->assertFalse($christmas->isHoliday());
		$this->assertTrue($christmas->isChristmasDay()); // Individual method still works
	}

	#[Test]
	public function liberation_day_true_works_every_year(): void
	{
		config(['holidays.liberation_day' => true]);
		$this->refreshMixin();

		$this->assertTrue(Carbon::parse('2021-05-05')->isHoliday()); // Not divisible by 5
		$this->assertTrue(Carbon::parse('2025-05-05')->isHoliday()); // Divisible by 5
	}

	#[Test]
	public function liberation_day_false_never_works(): void
	{
		config(['holidays.liberation_day' => false]);
		$this->refreshMixin();

		$this->assertFalse(Carbon::parse('2021-05-05')->isHoliday());
		$this->assertFalse(Carbon::parse('2025-05-05')->isHoliday());
	}

	#[Test]
	public function liberation_day_once_every_5_years(): void
	{
		config(['holidays.liberation_day' => 'once-every-5-years']);
		$this->refreshMixin();

		// Years divisible by 5 - should be holidays
		$this->assertTrue(Carbon::parse('2020-05-05')->isHoliday());
		$this->assertTrue(Carbon::parse('2025-05-05')->isHoliday());
		$this->assertTrue(Carbon::parse('2030-05-05')->isHoliday());

		// Years NOT divisible by 5 - should NOT be holidays
		$this->assertFalse(Carbon::parse('2021-05-05')->isHoliday());
		$this->assertFalse(Carbon::parse('2022-05-05')->isHoliday());
		$this->assertFalse(Carbon::parse('2023-05-05')->isHoliday());
		$this->assertFalse(Carbon::parse('2024-05-05')->isHoliday());
		$this->assertFalse(Carbon::parse('2026-05-05')->isHoliday());
	}

	#[Test]
	public function multiple_holidays_can_be_disabled(): void
	{
		config([
			'holidays.good_friday' => false,
			'holidays.boxing_day' => false,
		]);
		$this->refreshMixin();

		$this->assertFalse(Carbon::parse('2021-04-02')->isHoliday()); // Good Friday
		$this->assertFalse(Carbon::parse('2021-12-26')->isHoliday()); // Boxing Day
		$this->assertTrue(Carbon::parse('2021-12-25')->isHoliday()); // Christmas still works
	}

	#[Test]
	public function config_does_not_affect_individual_methods(): void
	{
		config(['holidays.new_year' => false]);
		$this->refreshMixin();

		$newYear = Carbon::parse('2021-01-01');
		$this->assertFalse($newYear->isHoliday()); // Composite method respects config
		$this->assertTrue($newYear->isNewYear()); // Individual method ignores config
	}

	#[Test]
	public function works_with_carbon_immutable(): void
	{
		config(['holidays.kings_day' => false]);
		$this->refreshMixin();

		$kingsDay = CarbonImmutable::parse('2021-04-27');
		$this->assertFalse($kingsDay->isHoliday());
		$this->assertTrue($kingsDay->isKingsDay());
	}
}

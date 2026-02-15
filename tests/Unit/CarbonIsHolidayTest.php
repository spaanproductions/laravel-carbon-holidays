<?php

namespace SpaanProductions\LaravelCarbonHolidays\Tests\Unit;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use SpaanProductions\LaravelCarbonHolidays\Tests\TestCase;

class CarbonIsHolidayTest extends TestCase
{
	// Backward compatibility test
	#[Test]
	#[DataProvider('holidays')]
	public function we_can_check_the_holidays(Carbon $date): void
	{
		self::assertTrue($date->isHoliday());
	}

	public static function holidays(): array
	{
		return [
			'Nieuwjaarsdag 2021' => [Carbon::parse('2021-01-01')],
			'Nieuwjaarsdag 2022' => [Carbon::parse('2022-01-01')],
			'Goede Vrijdag 2021' => [Carbon::parse('2021-04-02')],
			'Goede Vrijdag 2022' => [Carbon::parse('2022-04-15')],
			'Pasen 2021' => [Carbon::parse('2021-04-04')],
			'Pasen 2022' => [Carbon::parse('2022-04-17')],
			'Paasmaandag 2021' => [Carbon::parse('2021-04-05')],
			'Koningsdag 2021' => [Carbon::parse('2021-04-27')],
			'Koningsdag 2022' => [Carbon::parse('2022-04-27')],
			'Koningsdag 2023' => [Carbon::parse('2023-04-27')],
			'Koningsdag 2024' => [Carbon::parse('2024-04-27')],
			'Koningsdag 2025 (zaterdag ipv zondag)' => [Carbon::parse('2025-04-26')],
			'Bevrijdingsdag 2020' => [Carbon::parse('2020-05-05')],
			'Bevrijdingsdag 2021' => [Carbon::parse('2021-05-05')],
			'Hemelvaartsdag 2021' => [Carbon::parse('2021-05-13')],
			'Hemelvaartsdag 2022' => [Carbon::parse('2022-05-26')],
			'1e Pinksterdag 2021' => [Carbon::parse('2021-05-23')],
			'2e Pinksterdag 2021' => [Carbon::parse('2021-05-24')],
			'1e Kerstdag 2021' => [Carbon::parse('2021-12-25')],
			'2e Kerstdag 2021' => [Carbon::parse('2021-12-26')],
		];
	}

	// Individual English method tests

	#[Test]
	#[DataProvider('newYearDates')]
	public function test_is_new_year(Carbon $date): void
	{
		self::assertTrue($date->isNewYear());
	}

	public static function newYearDates(): array
	{
		return [
			[Carbon::parse('2020-01-01')],
			[Carbon::parse('2021-01-01')],
			[Carbon::parse('2022-01-01')],
			[Carbon::parse('2023-01-01')],
			[Carbon::parse('2024-01-01')],
			[Carbon::parse('2025-01-01')],
			[Carbon::parse('2026-01-01')],
		];
	}

	#[Test]
	#[DataProvider('goodFridayDates')]
	public function test_is_good_friday(Carbon $date): void
	{
		self::assertTrue($date->isGoodFriday());
	}

	public static function goodFridayDates(): array
	{
		return [
			[Carbon::parse('2020-04-10')],
			[Carbon::parse('2021-04-02')],
			[Carbon::parse('2022-04-15')],
			[Carbon::parse('2023-04-07')],
			[Carbon::parse('2024-03-29')],
			[Carbon::parse('2025-04-18')],
			[Carbon::parse('2026-04-03')],
		];
	}

	#[Test]
	#[DataProvider('easterSundayDates')]
	public function test_is_easter_sunday(Carbon $date): void
	{
		self::assertTrue($date->isEasterSunday());
	}

	public static function easterSundayDates(): array
	{
		return [
			[Carbon::parse('2020-04-12')],
			[Carbon::parse('2021-04-04')],
			[Carbon::parse('2022-04-17')],
			[Carbon::parse('2023-04-09')],
			[Carbon::parse('2024-03-31')],
			[Carbon::parse('2025-04-20')],
			[Carbon::parse('2026-04-05')],
		];
	}

	#[Test]
	#[DataProvider('easterMondayDates')]
	public function test_is_easter_monday(Carbon $date): void
	{
		self::assertTrue($date->isEasterMonday());
	}

	public static function easterMondayDates(): array
	{
		return [
			[Carbon::parse('2020-04-13')],
			[Carbon::parse('2021-04-05')],
			[Carbon::parse('2022-04-18')],
			[Carbon::parse('2023-04-10')],
			[Carbon::parse('2024-04-01')],
			[Carbon::parse('2025-04-21')],
			[Carbon::parse('2026-04-06')],
		];
	}

	#[Test]
	#[DataProvider('kingsDayDates')]
	public function test_is_kings_day(Carbon $date): void
	{
		self::assertTrue($date->isKingsDay());
	}

	public static function kingsDayDates(): array
	{
		return [
			[Carbon::parse('2020-04-27')], // Monday
			[Carbon::parse('2021-04-27')], // Tuesday
			[Carbon::parse('2022-04-27')], // Wednesday
			[Carbon::parse('2023-04-27')], // Thursday
			[Carbon::parse('2024-04-27')], // Saturday
			[Carbon::parse('2025-04-26')], // Moved from Sunday
			[Carbon::parse('2026-04-27')], // Monday
		];
	}

	#[Test]
	#[DataProvider('liberationDayDates')]
	public function test_is_liberation_day(Carbon $date): void
	{
		self::assertTrue($date->isLiberationDay());
	}

	public static function liberationDayDates(): array
	{
		return [
			[Carbon::parse('2020-05-05')],
			[Carbon::parse('2021-05-05')],
			[Carbon::parse('2022-05-05')],
			[Carbon::parse('2023-05-05')],
			[Carbon::parse('2024-05-05')],
			[Carbon::parse('2025-05-05')],
			[Carbon::parse('2026-05-05')],
		];
	}

	#[Test]
	#[DataProvider('ascensionDayDates')]
	public function test_is_ascension_day(Carbon $date): void
	{
		self::assertTrue($date->isAscensionDay());
	}

	public static function ascensionDayDates(): array
	{
		return [
			[Carbon::parse('2020-05-21')],
			[Carbon::parse('2021-05-13')],
			[Carbon::parse('2022-05-26')],
			[Carbon::parse('2023-05-18')],
			[Carbon::parse('2024-05-09')],
			[Carbon::parse('2025-05-29')],
			[Carbon::parse('2026-05-14')],
		];
	}

	#[Test]
	#[DataProvider('pentecostDates')]
	public function test_is_pentecost(Carbon $date): void
	{
		self::assertTrue($date->isPentecost());
	}

	public static function pentecostDates(): array
	{
		return [
			[Carbon::parse('2020-05-31')],
			[Carbon::parse('2021-05-23')],
			[Carbon::parse('2022-06-05')],
			[Carbon::parse('2023-05-28')],
			[Carbon::parse('2024-05-19')],
			[Carbon::parse('2025-06-08')],
			[Carbon::parse('2026-05-24')],
		];
	}

	#[Test]
	#[DataProvider('pentecostMondayDates')]
	public function test_is_pentecost_monday(Carbon $date): void
	{
		self::assertTrue($date->isPentecostMonday());
	}

	public static function pentecostMondayDates(): array
	{
		return [
			[Carbon::parse('2020-06-01')],
			[Carbon::parse('2021-05-24')],
			[Carbon::parse('2022-06-06')],
			[Carbon::parse('2023-05-29')],
			[Carbon::parse('2024-05-20')],
			[Carbon::parse('2025-06-09')],
			[Carbon::parse('2026-05-25')],
		];
	}

	#[Test]
	#[DataProvider('christmasDayDates')]
	public function test_is_christmas_day(Carbon $date): void
	{
		self::assertTrue($date->isChristmasDay());
	}

	public static function christmasDayDates(): array
	{
		return [
			[Carbon::parse('2020-12-25')],
			[Carbon::parse('2021-12-25')],
			[Carbon::parse('2022-12-25')],
			[Carbon::parse('2023-12-25')],
			[Carbon::parse('2024-12-25')],
			[Carbon::parse('2025-12-25')],
			[Carbon::parse('2026-12-25')],
		];
	}

	#[Test]
	#[DataProvider('boxingDayDates')]
	public function test_is_boxing_day(Carbon $date): void
	{
		self::assertTrue($date->isBoxingDay());
	}

	public static function boxingDayDates(): array
	{
		return [
			[Carbon::parse('2020-12-26')],
			[Carbon::parse('2021-12-26')],
			[Carbon::parse('2022-12-26')],
			[Carbon::parse('2023-12-26')],
			[Carbon::parse('2024-12-26')],
			[Carbon::parse('2025-12-26')],
			[Carbon::parse('2026-12-26')],
		];
	}

	// Dutch method tests

	#[Test]
	#[DataProvider('newYearDates')]
	public function test_is_nieuwjaarsdag(Carbon $date): void
	{
		self::assertTrue($date->isNieuwjaarsdag());
	}

	#[Test]
	#[DataProvider('goodFridayDates')]
	public function test_is_goede_vrijdag(Carbon $date): void
	{
		self::assertTrue($date->isGoedeVrijdag());
	}

	#[Test]
	#[DataProvider('easterSundayDates')]
	public function test_is_paaszondag(Carbon $date): void
	{
		self::assertTrue($date->isPaaszondag());
	}

	#[Test]
	#[DataProvider('easterMondayDates')]
	public function test_is_paasmaandag(Carbon $date): void
	{
		self::assertTrue($date->isPaasmaandag());
	}

	#[Test]
	#[DataProvider('kingsDayDates')]
	public function test_is_koningsdag(Carbon $date): void
	{
		self::assertTrue($date->isKoningsdag());
	}

	#[Test]
	#[DataProvider('liberationDayDates')]
	public function test_is_bevrijdingsdag(Carbon $date): void
	{
		self::assertTrue($date->isBevrijdingsdag());
	}

	#[Test]
	#[DataProvider('ascensionDayDates')]
	public function test_is_hemelvaart(Carbon $date): void
	{
		self::assertTrue($date->isHemelvaart());
	}

	#[Test]
	#[DataProvider('pentecostDates')]
	public function test_is_pinksterzondag(Carbon $date): void
	{
		self::assertTrue($date->isPinksterzondag());
	}

	#[Test]
	#[DataProvider('pentecostMondayDates')]
	public function test_is_pinkstermaandag(Carbon $date): void
	{
		self::assertTrue($date->isPinkstermaandag());
	}

	#[Test]
	#[DataProvider('christmasDayDates')]
	public function test_is_eerste_kerstdag(Carbon $date): void
	{
		self::assertTrue($date->isEersteKerstdag());
	}

	#[Test]
	#[DataProvider('boxingDayDates')]
	public function test_is_tweede_kerstdag(Carbon $date): void
	{
		self::assertTrue($date->isTweedeKerstdag());
	}

	// Alias tests

	#[Test]
	#[DataProvider('pentecostDates')]
	public function test_is_whitsunday(Carbon $date): void
	{
		self::assertTrue($date->isWhitsunday());
	}

	#[Test]
	#[DataProvider('pentecostMondayDates')]
	public function test_is_whit_monday(Carbon $date): void
	{
		self::assertTrue($date->isWhitMonday());
	}

	#[Test]
	#[DataProvider('ascensionDayDates')]
	public function test_is_hemelvaartsdag(Carbon $date): void
	{
		self::assertTrue($date->isHemelvaartsdag());
	}

	// Negative tests

	#[Test]
	#[DataProvider('nonHolidayDates')]
	public function test_non_holidays_return_false(Carbon $date): void
	{
		self::assertFalse($date->isHoliday());
		self::assertFalse($date->isNewYear());
		self::assertFalse($date->isChristmasDay());
		self::assertFalse($date->isKingsDay());
	}

	public static function nonHolidayDates(): array
	{
		return [
			[Carbon::parse('2021-06-15')],
			[Carbon::parse('2021-07-20')],
			[Carbon::parse('2021-08-10')],
			[Carbon::parse('2021-09-05')],
			[Carbon::parse('2021-10-12')],
		];
	}

	// Test edge case: King's Day 2025 (Sunday moves to Saturday)

	#[Test]
	public function test_kings_day_sunday_edge_case(): void
	{
		// April 27, 2025 is Sunday - should NOT be King's Day
		self::assertFalse(Carbon::parse('2025-04-27')->isKingsDay());
		self::assertFalse(Carbon::parse('2025-04-27')->isKoningsdag());

		// April 26, 2025 should be King's Day (moved from Sunday)
		self::assertTrue(Carbon::parse('2025-04-26')->isKingsDay());
		self::assertTrue(Carbon::parse('2025-04-26')->isKoningsdag());
	}

	// CarbonImmutable compatibility tests

	#[Test]
	public function test_carbon_immutable_compatibility(): void
	{
		$date = CarbonImmutable::parse('2021-12-25');
		self::assertTrue($date->isHoliday());
		self::assertTrue($date->isChristmasDay());
		self::assertTrue($date->isEersteKerstdag());

		$date = CarbonImmutable::parse('2025-04-26');
		self::assertTrue($date->isKingsDay());
		self::assertTrue($date->isKoningsdag());

		$date = CarbonImmutable::parse('2021-06-15');
		self::assertFalse($date->isHoliday());
	}
}

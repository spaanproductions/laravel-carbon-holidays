<?php

namespace SpaanProductions\LaravelCarbonHolidays\Tests\Unit;

use Carbon\Carbon;
use SpaanProductions\LaravelCarbonHolidays\Tests\TestCase;

class CarbonIsHolidayTest extends TestCase
{
	/**
	 * @test
	 * @dataProvider holidays
	 * @param Carbon $date
	 */
	public function we_can_check_the_holidays(Carbon $date)
	{
		self::assertTrue($date->isHoliday());
	}

	public static function holidays()
	{
		return [
			[Carbon::parse('2021-01-01')], // Nieuwjaarsdag 2021
			[Carbon::parse('2022-01-01')], // Nieuwjaarsdag 2022
			[Carbon::parse('2021-04-02')], // Goede Vrijdag 2021
			[Carbon::parse('2022-04-15')], // Goede Vrijdag 2022
			[Carbon::parse('2021-04-04')], // Pasen 2021
			[Carbon::parse('2022-04-17')], // Pasen 2022
			[Carbon::parse('2021-04-05')], // Paasmaandag 2021
			[Carbon::parse('2021-04-27')], // Koningsdag 2021
			[Carbon::parse('2022-04-27')], // Koningsdag 2022
			[Carbon::parse('2023-04-27')], // Koningsdag 2023
			[Carbon::parse('2024-04-27')], // Koningsdag 2024
			[Carbon::parse('2025-04-26')], // Koningsdag 2025 (zaterdag ipv zondag)
			[Carbon::parse('2020-05-05')], // Bevreidingsdag 2020
			[Carbon::parse('2021-05-05')], // Bevreidingsdag 2021
			[Carbon::parse('2021-05-13')], // Hemelvaartsdag 2021
			[Carbon::parse('2022-05-26')], // Hemelvaartsdag 2022
			[Carbon::parse('2021-05-23')], // 1e Pinksterdag 2021
			[Carbon::parse('2021-05-24')], // 2e Pinksterdag 2021
			[Carbon::parse('2021-12-25')], // 1e Kerstdag 2021
			[Carbon::parse('2021-12-26')], // 2e Kerstdag 2021
		];
	}
}

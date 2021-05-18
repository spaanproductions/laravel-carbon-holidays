<?php

namespace SpaanProductions\LaravelCarbonHolidays;

use Carbon\Carbon;

class LaravelCarbonHolidays
{
	public function isHoliday()
	{
		/**
		 * 'new-year'           => '01/01', // Nieuwjaarsdag
		 * 'easter'             => '= easter', // Paaszondag
		 * 'easter-monday'      => '= easter + 1', // Paasmaandag
		 * 'royal-day'          => '= 04-27 if Sunday then -1 day', // Koningsdag
		 * 'liberation-day'     => '= 05-05 every 5 years since 1945', // Bevrijdingsdag
		 * 'ascension'          => '= easter + 39', // Hemelvaart
		 * 'pentecost'          => '= easter + 49', // Pinksterzondag
		 * 'pentecost-monday'   => '= easter + 50', // Pinkstermaandag
		 * 'christmas'          => '25/12', // Eerste Kerstdag
		 * 'christmas-next-day' => '26/12', // Tweede Kerstdag
		 */

		return function () {
			/** @var Carbon $this */
			$year = $this->year;

			$newYear       = Carbon::createFromDate($year, 01, 01);
			$easter        = Carbon::createFromDate($year, 03, 21)->addDays(easter_days($year));
			$royalDay      = Carbon::createFromDate($year, 04, 27);
			$liberationDay = Carbon::createFromDate($year, 05, 05);
			$ascension     = $easter->clone()->addDays(39);
			$pentecost     = $easter->clone()->addDays(49);
			$christmas     = Carbon::createFromDate($year, 12, 25);

			if ($royalDay->isSunday()) {
				$royalDay->subDay();
			}

			// 'new-year' => '01/01', // Nieuwjaarsdag
			if ($this->isSameDay($newYear)) {
				return true;
			}

			// 'easter' => '= easter',
			if ($this->isSameDay($easter)) {
				return true;
			}

			// 'easter-monday' => '= easter + 1',
			if ($this->isSameDay($easter->clone()->addDay())) {
				return true;
			}

			// 'royal-day' => '= 04-27 if Sunday then -1 day',
			if ($this->isSameDay($royalDay)) {
				return true;
			}

			// 'liberation-day' => '= 05-05 every 5 years since 1945',
			if ($this->isSameDay($liberationDay) && $year % 5 === 0) {
				return true;
			}

			// 'ascension' => '= easter + 39',
			if ($this->isSameDay($ascension)) {
				return true;
			}

			// 'pentecost' => '= easter + 49',
			if ($this->isSameDay($pentecost)) {
				return true;
			}

			// 'pentecost-monday' => '= easter + 50',
			if ($this->isSameDay($pentecost->clone()->addDay())) {
				return true;
			}

			// 'christmas' => '25/12', // Eerste Kerstdag
			if ($this->isSameDay($christmas)) {
				return true;
			}

			// 'christmas-next-day' => '26/12', // Tweede Kerstdag
			if ($this->isSameDay($christmas->clone()->addDay())) {
				return true;
			}

			return false;
		};
	}
}

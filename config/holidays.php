<?php

return [
    // New Year's Day - January 1
    'new_year' => true,

    // Good Friday - Easter Sunday minus 2 days
    'good_friday' => true,

    // Easter Sunday - Calculated using Easter algorithm
    'easter_sunday' => true,

    // Easter Monday - Easter Sunday plus 1 day
    'easter_monday' => true,

    // King's Day - April 27 (or April 26 if April 27 is Sunday)
    'kings_day' => true,

    // Liberation Day - May 5
    // Special values:
    // - true: Always considered a holiday (default)
    // - false: Never considered a holiday
    // - 'once-every-5-years': Only in years divisible by 5 (2020, 2025, 2030...)
    'liberation_day' => true,

    // Ascension Day - Easter Sunday plus 39 days
    'ascension_day' => true,

    // Pentecost (Whitsunday) - Easter Sunday plus 49 days
    'pentecost' => true,

    // Pentecost Monday - Easter Sunday plus 50 days
    'pentecost_monday' => true,

    // Christmas Day - December 25
    'christmas_day' => true,

    // Boxing Day - December 26
    'boxing_day' => true,
];

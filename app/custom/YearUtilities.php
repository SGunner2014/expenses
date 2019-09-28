<?php

namespace App\custom;

/**
 * Contains useful functions for interacting with a year
 * @package App\custom
 */
class YearUtilities {
    private $beginning;
    private $months;

    /*
     * Constructor for YearUtilities
     * Where:
     *
     * $year = 2019, 2020, etc...
     */
    public function __construct($year) {
        // we need to figure out how many days each month has
        $this->beginning = intval($year);
        $this->generateMonths();
    }

    public function getMonths() {
        return $this->months;
    }

    // Generates a month given its starting date and the number of months remaining
    private function generateMonths() {
        $this->months = [];

        for ($i = 0; $i < 12; $i++) {
            $days = cal_days_in_month(CAL_GREGORIAN, $i + 1, $this->beginning);
            array_push($this->months, $days);
        }
    }
}

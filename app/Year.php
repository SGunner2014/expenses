<?php

namespace App;

use App\custom\YearUtilities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Year extends Model
{
    protected $guarded = [];

    /**
     * Checks to see if the associated months have already been registered, and if not, registers them.
     * @param $year integer The number of the year, e.g. 2019, 2020 etc...
     */
    public function createAssociatedMonths($year) {
        $yearUtilities = new YearUtilities($year);
        $monthNums = $yearUtilities->getMonths(); // Get the days for each month
        $months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];

        // If the financial year runs from april -> april:
        $reverseMap = [
            1 => 10, // jan - this is the point at which we need to account for a fresh year!
            2 => 11, // feb
            3 => 12,
            4 => 1,
            5 => 2,
            6 => 3,
            7 => 4,
            8 => 5,
            9 => 6,
            10 => 7,
            11 => 8,
            12 => 9
        ];

        // Loop through each month within the year
        // we need to make sure we calculate the correct number of days for this month
        // i.e. we need to figure out whether the reverse mapping above is
        for ($i = 0; $i < count($reverseMap); $i++) {
            $month = new Month();
            $month->yearid = $this->id;
            $month->name = $months[$i];
            $month->owner_id = Auth::id();
            $month->reverseMapping = $reverseMap[$i + 1];
            $month->month = $i + 1;
            $month->literalYear = $reverseMap[$i + 1] >= 10 ? $this->year + 1 : $this->year;
            $month->save();
            $noDays = cal_days_in_month(CAL_GREGORIAN, $i + 1,
                $reverseMap[$i + 1] >= 10 ? $this->year + 1 : $this->year);
            $month->createAssociatedWeeks($monthNums[$i], $noDays); // tell it create the associated weeks
        }
    }

    public function getMonths() {
        return Month::where("yearid", "=", $this->id)->get()->sortBy("reverseMapping");
    }
}

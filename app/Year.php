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
        $counter = 1;
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

        // Loop through each month and register the weeks and then the days
        foreach ($monthNums as $monthNum) {
            $month = new Month();
            $month->yearid = $this->id;
            $month->month = $counter;
            $month->name = $months[$counter - 1];
            $month->owner_id = Auth::id();
            $month->save();
            $month->createAssociatedWeeks($monthNum);

            $counter++;
        }
    }

    public function getMonths() {
        return Month::where("yearid", "=", $this->id)->get();
    }
}

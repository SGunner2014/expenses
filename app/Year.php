<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Year extends Model
{
    protected $guarded = [];

    /**
     * Checks to see if the associated months have already been registered, and if not, registers them.
     */
    public function createAssociatedMonths() {
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

        if (count(Month::where("yearid", "=", $this->id)->get()) == 0) {
            for ($i = 0; $i < count($months); $i++) {
                $month = new Month();
                $month->yearid = $this->id;
                $month->month = $i + 1;
                $month->name = $months[$i];
                $month->owner_id = Auth::id();
                $month->save();
                $month->createAssociatedWeeks();
            }
        }
    }

    public function getMonths() {
        return Month::where("yearid", "=", $this->id)->get();
    }
}

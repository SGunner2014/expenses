<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    public function getDay() {
        return Day::find($this->dayid);
    }

    public function getWeekNo() {
        return Week::find($this->weekid)->week;
    }

    public function getMonth() {
        return Month::find(Week::find($this->weekid)->monthid)->name;
    }

    public function getYear() {
        return Year::find(Month::find(Week::find($this->weekid)->monthid)->yearid)->year;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Month extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Checks to see if the associated weeks have already been registered, and if not, registers them.
     * @param $noDays integer The number of days in the month
     */
    public function createAssociatedWeeks($noDays, $yearNum) {
        $children = Child::where("active", "=", true)->where("owner_id", auth()->id())->get();
        $noWeeks = ceil($noDays / 7); // Get the number of weeks and round it up
        $remainder = $noDays % 7; // See how many days we need in the last week

        if (count(Week::where("monthid", "=", $this->id)->get()) == 0) { // check the month exists
            for ($i = 0; $i < $noWeeks; $i++) {
                $week = new Week();
                $week->week = $i + 1;
                $week->monthid = $this->id;
                $week->owner_id = Auth::id();
                $week->save();
                $weekDayNo = $week->generateDays($i == $noWeeks - 1 && $remainder != 0 ? $remainder : 7,
                    $i * 7,
                    $this->month,
                    Year::find($this->yearid)->year); // default to 7 days each week

                // Now, we register each child's expenses on the first day of every week
                foreach ($children as $child) {
                    $expense = new Expense();
                    $expense->type = 1;
                    $expense->category = 1;
                    $expense->amount = $child->foodCosts;
                    $expense->weekid = $week->id;
                    $expense->dayid = $weekDayNo;
                    $expense->date = $week->getFirstDay()->timestamp;
                    $expense->childid = $child->id;
                    $expense->owner_id = Auth::id();
                    $expense->save();
                }

                if ($i == 0) {
                    $recurring = Recurring::where("active", "=", true)->where("owner_id", auth()->id())->get();
                    foreach ($recurring as $recur) {
                        $expense = new Expense();
                        $expense->type = 3;
                        $expense->category = $recur->category;
                        $expense->amount = $recur->amount;
                        $expense->details = $recur->details;
                        $expense->weekid = $week->id;
                        $expense->owner_id = Auth::id();
                        $expense->dayid = $weekDayNo;
                        $expense->date = $week->getFirstDay()->timestamp;
                        $expense->save();
                    }
                }
            }
        }
    }

    /**
     * Returns all associated weeks
     * @return mixed
     */
    public function getWeeks() {
        return Week::where("monthid", "=", $this->id)->get();
    }
}

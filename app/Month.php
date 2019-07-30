<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Checks to see if the associated weeks have already been registered, and if not, registers them.
     */
    public function createAssociatedWeeks() {
        $children = Child::where("active", "=", true)->get();

        if (count(Week::where("monthid", "=", $this->id)->get()) == 0) {
            for ($i = 0; $i < 5; $i++) {
                $week = new Week();
                $week->week = $i + 1;
                $week->monthid = $this->id;
                $week->save();

                // Now, time to create the recurring children for this week!
                foreach ($children as $child) {
                    // fetch food & drink, create expense
                    $expense = new Expense();
                    $expense->type = 1;
                    $expense->category = 1;
                    $expense->amount = $child->foodCosts;
                    $expense->weekid = $week->id;
                    $expense->childid = $child->id;
                    $expense->save();
                }

                // Now, we need to add the monthly recurring expenses
                if ($i == 0) {
                    $recurring = Recurring::where("active", "=", true)->get();
                    foreach ($recurring as $recur) {
                        $expense = new Expense();
                        $expense->type = 3;
                        $expense->category = $recur->category;
                        $expense->amount = $recur->amount;
                        $expense->details = $recur->details;
                        $expense->weekid = $week->id;
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

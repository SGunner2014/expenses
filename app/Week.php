<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    /**
     * Returns all expenses for children within the week.
     */
    public function getChildExpenses() {
        // We need to find all the expenses for this period and then we need to return these in a sorted array, by each child
        $weeksExpenses = Expense::where("weekid", "=", $this->id);
        $childrenExpenses = $weeksExpenses->where("type", "=", 1);
        $groupedChildrenExpenses = $childrenExpenses->get()->groupBy("childid");

        $toReturn = [];

        foreach($groupedChildrenExpenses as $childExpenses) {
            $temp = [];
            $temp[0] = Child::where("id", "=", $childExpenses[0]->childid)->get()->first()->name;
            foreach ($childExpenses as $expense) {
                $expense->amount = $expense->amount / 100;
                $temp[$expense["category"]] = $expense;
            }

            for ($i = 2; $i < 7; $i++) {
                if (!array_key_exists($i, $temp)) {
                    $temp[$i] = new Expense();
                    $temp[$i]->amount = 0;
                }
            }

            array_push($toReturn, $temp);
        }

        return $toReturn;
    }
}

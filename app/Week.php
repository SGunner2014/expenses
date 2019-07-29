<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    /**
     * Returns all expenses for children within the week.
     */
    public function getChildExpenses() {
        $expenses = Expense::where("type", "=", "1")->where("weekid", "=", $this->id);

        $toReturn = [];
        foreach ($expenses as $expense) {
            if (!array_key_exists($expense["childid"], $toReturn)) {
                $toReturn[$expense["childid"]] = [];
                $toReturn["name"] = Child::where("id", "=", $expense["childid"])->get()->first()->name;
            }

            array_push($toReturn[$expense["childid"]], $expense);
        }

        return $toReturn;
    }
}

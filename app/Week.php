<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    /**
     * Returns the first day of the week
     */
    public function getFirstDay() {
        return Day::where("weekid", $this->id)->get()->sortBy("timestamp")->first();
    }

    /**
     * Returns all expenses for children within the week.
     */
    public function getExpenses() {
        // just find all the expenses for this week
        // regualr child expenses need to come first
        // then recurring
        // then one-off
        $childExpenses = Expense::where("weekid", "=", $this->id)->where("type", "=", 1)->get()->groupBy("childid");
        $recurringExpenses = Expense::where("weekid", "=", $this->id)->where("type", "=", 3)->get();
        $oneOffs = Expense::where("weekid", "=", $this->id)->where("type", "=", 2)->get();

        $toReturn = [];
        $toReturn["child"] = [];
        $toReturn["recurring"] = [];
        $toReturn["oneoff"] = [];
        $toReturn["total"] = [];
        $toReturn["total"]["total"] = [
            "integer" => 0,
            "display" => "£0.00"
        ];

        // Process child expense and form a displayable format
        foreach ($childExpenses as $childExpense) {
             $toAdd = [];
             for ($i = 1; $i < 7; $i++) {
                 $toAdd[$i] = [
                     "display" => "£0.00",
                     "integer" => 0
                 ];
             }

             foreach ($childExpense as $ce) {
                 $toAdd[$ce->category] = [
                     "display" => "£" . number_format($ce->amount / 100, 2),
                     "integer" => $ce->amount
                 ];
                 if (!array_key_exists("details", $toAdd)) {
                     $child = Child::where("id", "=", $ce->childid)->get()->first();
                     $toAdd["details"] = $child->name;
                     $toAdd["id"] = $ce->id;
                     $toAdd["date"] = date("d/m/Y", $ce->date);
                 }
             }

             // now, get the total from each section
             $toAdd["total"] = 0;
             for ($i = 1; $i < 7; $i++) {
                 $toAdd["total"] += $toAdd[$i]["integer"];
             }
             $toAdd["total"] = [
                 "display" => "£" . number_format($toAdd["total"] / 100, 2),
                 "integer" => $toAdd["total"],
             ];
             array_push($toReturn["child"], $toAdd);
         }

        // Process recurring expenses and form a displayable format
        foreach ($recurringExpenses as $childExpense) {
            $toAdd = [];

            for ($i = 1; $i < 7; $i++) {
                $toAdd[$i] = [
                    "display" => "£0.00",
                    "integer" => 0
                ];
            }

            $toAdd[$childExpense->category] = [
                "display" => "£" . number_format($childExpense->amount / 100, 2),
                "integer" => $childExpense->amount
            ];

            $toAdd["total"] = [
                "display" => "£" . number_format($childExpense->amount / 100, 2),
                "integer" => $childExpense->amount
            ];

            $toAdd["details"] = $childExpense->details;
            $toAdd["id"] = $childExpense->id;

            // Now, format the date
            $toAdd["date"] = date("d/m/Y", $childExpense->date);

            array_push($toReturn["recurring"], $toAdd);
        }

        // Process one-off expenses and form a displayable format
        foreach ($oneOffs as $expense) {
            $toAdd = [];

            for ($i = 1; $i < 7; $i++) {
                $toAdd[$i] = [
                    "display" => "£0.00",
                    "integer" => 0
                ];
            }

            $toAdd[$expense->category] = [
                "display" => "£" . number_format($expense->amount / 100, 2),
                "integer" => $expense->amount
            ];

            $toAdd["total"] = [
                "display" => "£" . number_format($expense->amount / 100, 2),
                "integer" => $expense->amount
            ];

            $toAdd["details"] = $expense->details;
            $toAdd["id"] = $expense->id;
            $toAdd["date"] = date("d/m/Y", $expense->date);

            array_push($toReturn["oneoff"], $toAdd);
        }

        // Process totals and form a displayable format
        for ($i = 1; $i < 7; $i++) {
            $toReturn["total"][$i] = [
                "integer" => 0
            ];

            // Add in child expenses
            foreach ($toReturn["child"] as $childExpense) {
                $toReturn["total"][$i]["integer"] += $childExpense[$i]["integer"];
            }

            // Add in recurring expenses
            foreach ($toReturn["recurring"] as $recurring) {
                $toReturn["total"][$i]["integer"] += $recurring[$i]["integer"];
            }

            foreach ($toReturn["oneoff"] as $oneoff) {
                $toReturn["total"][$i]["integer"] += $oneoff[$i]["integer"];
            }


            $toReturn["total"]["total"]["integer"] += $toReturn["total"][$i]["integer"];
            $toReturn["total"][$i]["display"] = "£" . number_format($toReturn["total"][$i]["integer"] / 100, 2);
        }

        $toReturn["total"]["total"]["display"] = "£" . number_format($toReturn["total"]["total"]["integer"] / 100, 2);

        return $toReturn;
    }

    /**
     * Returns the full human-readable name for this week
     */
    public function getFullName() {
        $month = Month::find($this->monthid);
        $year = Year::find($month->yearid);

        return $month->name . ", " . $year->year;
    }

    /**
     * Generates the associated days for a week
     * @param $noDays integer The number of days in the week
     * @param $monthNo integer The starting number for the first day of the week
     * @param $month integer The month that these days form
     * @param $year integer The year that these days form
     * @return int The starting number for the first day
     */
    public function generateDays($noDays, $monthNo, $month, $year) {
        for ($i = 0; $i < $noDays; $i++) {
            // form a date
            $humanReadable = ($monthNo + $i + 1) . "-" . $month . "-" . $year;
            // convert to epoch form
            $dte = strtotime($humanReadable);
            $day = new Day();
            $day->weekid = $this->id;
            $day->monthNo = $monthNo + $i + 1;
            $day->timestamp = $dte;
            $day->save();
        }

        return $monthNo + 1;
    }
}

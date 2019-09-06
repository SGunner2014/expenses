<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Year;
use Illuminate\Http\Request;
use App\Week;
use App\Month;
use Illuminate\Support\Facades\Input;

class ExpensesController extends Controller
{
    public function edit(Expense $expense) {
        return view("expenses.edit", compact("expense"));
    }

    public function update(Expense $expense, Request $request) {
        $this->authorize("update", $expense);

        $validator = [
            "amount" => ["required"],
            "category" => ["required"]
        ];

        $data = $request->validate($validator);
        $data["amount"] = round($data["amount"] * 100, 0);
        $expense->update($data);
        $monthid = Week::find($expense->weekid)->monthid;
        $yearid = Month::find(Week::find($expense->weekid)->monthid)->yearid;

        return redirect("/years/" . $yearid . "/months/" . $monthid);
    }

    /**
     * Registers a new one-off expense
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {
        $weekid = Input::get("week");
        $week = Week::where("id", $weekid)->first(); // Get the relevant week
        $this->authorize("update", $week); // Make sure we have permission to add an expense for this week

        return view("expenses.create", compact("week"));
    }

    /**
     * Registers a new one-off expense
     * @param Request $request
     */
    public function store(Request $request) {
        $validator = [
            "details" => ["min:3", "max:2000"],
            "category" => ["required"],
            "amount" => ["min:0"],
            "weekid" => ["required"]
        ];

        $fields = $request->validate($validator);
        $week = Week::find($fields["weekid"]);
        $this->authorize("update", $week);

        $fields["weekid"] = $week->id;
        $fields["owner_id"] = auth()->id();
        $fields["type"] = 2;
        $fields["amount"] = round($fields["amount"], 0) * 100;
        $expense = Expense::create($fields);
        $expense->save();
        $month = Month::find($week->monthid);
        $year = Year::find($month->yearid);
        return redirect("/years/" . $year->id . "/months/" . $month->id);
    }

    /**
     * Removes an expense from the database
     * @param Expense $expense
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Expense $expense) {
        $this->authorize("update", $expense);

        $week = Week::find($expense->weekid);
        $month = Month::find($week->monthid);
        $expense->delete();
        return redirect("/years/" . $month->yearid . "/months/" . $month->id);
    }
}

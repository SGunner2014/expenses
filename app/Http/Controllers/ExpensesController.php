<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use App\Week;
use App\Month;

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
}

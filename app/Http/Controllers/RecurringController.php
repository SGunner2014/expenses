<?php

namespace App\Http\Controllers;

use App\Recurring;
use Illuminate\Http\Request;

class RecurringController extends Controller
{
    public function index() {
        $recurring = Recurring::where("active", "=", true)->get();
        $inactive = Recurring::where("active", "=", false)->get();
        return view("recurring.index", compact("recurring", "inactive"));
    }

    public function create() {
        return view("recurring.create");
    }

    public function store(Request $request) {
        $validator = [
            "details" => ["required", "min:3", "max:200"],
            "category" => ["required"],
            "amount" => ["required", "min:0"],
            "active" => ["required"]
        ];

        $fields = $request->validate($validator);
        $recur = new Recurring();
        $recur->details = $fields["details"];
        $recur->category = $fields["category"];
        $recur->amount = round($fields["amount"] * 100, 0);
        $recur->active = $fields["active"] == "on" ? true : false;
        $recur->save();

        return redirect("/recurring");
    }

    public function edit($id) {
        $payment = Recurring::find($id);
        return view("recurring.edit", compact("payment"));
    }
}

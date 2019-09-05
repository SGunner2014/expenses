<?php

namespace App\Http\Controllers;

use App\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->only(["update"]);
    }

    public function index() {
        $active = Child::where("active", "=", true)->where("owner_id", auth()->id())->get()->sortByDesc("startDate");
        $inactive = Child::where("active", "=", false)->where("owner_id", auth()->id())->get()->sortByDesc("endDate");
        return view("children.index", compact("active", "inactive"));
    }

    public function create() {
        return view("children.create");
    }

    public function store(Request $request) {
        $validity = [
            "name" => ["required", "min:3", "max:100"],
            "startDate" => ["required"],
            "endDate" => ["min:0"],
            "active" => ["required"],
            "foodCosts" => ["required", "min:0", "max:2000"]
        ];

        $fields = $request->validate($validity);
        $startDate = strtotime($fields["startDate"]);
        $endDate = (array_key_exists("endDate", $fields)) ? strtotime($fields["endDate"]) : null;
        $active = $fields["active"] == "on" ? true : false;

        $child = new Child();
        $child->name = $fields["name"];
        $child->startDate = $startDate;
        $child->endDate = $endDate;
        $child->active = $active;
        $child->foodCosts = round($fields["foodCosts"] * 100, 0); // only account for pence
        $child->owner_id = Auth::id();
        $child->save();

        return redirect("/children");
    }

    public function update(Child $child, Request $request) {
        $this->authorize("update", $child);

        $validator = [
            "active" => ["required"]
        ];

        $valid = $request->validate($validator);
        $valid["active"] = ($valid["active"] == "on") ? true : false;
        $child->update($valid);

        return redirect("/children");
    }
}

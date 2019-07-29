<?php

namespace App\Http\Controllers;

use App\Child;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function index() {
        $active = Child::where("active", "=", true)->get()->sortByDesc("startDate");
        $inactive = Child::where("active", "=", false)->get()->sortByDesc("endDate");
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
            "active" => ["required"]
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
        $child->save();

        return redirect("/children");
    }

    public function update(Child $child, Request $request) {
        $validator = [
            "active" => ["required"]
        ];

        $valid = $request->validate($validator);
        $valid["active"] = ($valid["active"] == "on") ? true : false;
        $child->update($valid);

        return redirect("/children");
    }
}

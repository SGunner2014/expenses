<?php

namespace App\Http\Controllers;

use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YearController extends Controller
{
    public function index() {
        $years = Year::all()->where("owner_id", auth()->id())->sortByDesc("created_at")->take(5);

        return view("years.index", compact("years"));
    }

    /**
     * Called when the user wants to register a new year
     */
    public function create() {
        return view("years.create");
    }

    /**
     * Called when a year is registered
     * @param Request $request The request received
     */
    public function store(Request $request) {
        // When we create a new year, we also need to create the associated months!
        $validator = [
            "year" => "required"
        ];
        $fields = $request->validate($validator);
        $fields["owner_id"] = Auth::id();
        $year = Year::create($fields);
        $year->save();
        $year->createAssociatedMonths();

        return redirect("/years/" . $year->id);
    }

    /**
     * Shows an existing year
     * @param Year $year
     */
    public function show(Year $year) {
        $this->authorize("update", $year);
        return view("years.show", compact("year"));
    }
}

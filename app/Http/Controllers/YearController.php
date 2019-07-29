<?php

namespace App\Http\Controllers;

use App\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index() {
        $years = Year::all()->sortByDesc("created_at")->take(5);

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
        $yearNo = $request->year;
        if (count(Year::where("year", "=", $yearNo)->get()) == 0) {
            // When we create a new year, we also need to create the associated months!
            $year = Year::create($request->all());
            $year->save();
            $year->createAssociatedMonths();

            return redirect("/years/" . $year->id);
        } else {
            return redirect("/years/create");
        }
    }

    /**
     * Shows an existing year
     * @param Year $year
     */
    public function show(Year $year) {
        return view("years.show", compact("year"));
    }
}

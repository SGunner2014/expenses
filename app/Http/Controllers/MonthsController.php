<?php

namespace App\Http\Controllers;

use App\Month;
use App\Year;
use Illuminate\Http\Request;

class MonthsController extends Controller
{
    public function show(Year $year, Month $month) {
        return view("months.show", compact("year", "month"));
    }
}

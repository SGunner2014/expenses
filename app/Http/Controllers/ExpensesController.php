<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function edit(Expense $expense) {
        return view("expenses.edit", compact("expense"));
    }
}

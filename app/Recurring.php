<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurring extends Model
{
    public function getCategoryText() {
        $categories = [
            1 => "Food and Drink",
            2 => "Toys and Equipment",
            3 => "Heating and Lighting",
            4 => "Water Rates/Council Tax",
            5 => "Travel/Outings",
            6 => "Miscellaneous"
        ];

        return $categories[$this->category];
    }
}

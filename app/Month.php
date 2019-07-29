<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->createAssociatedWeeks();
    }

    /**
     * Checks to see if the associated weeks have already been registered, and if not, registers them.
     */
    public function createAssociatedWeeks() {
        if (count(Week::where("monthid", "=", $this->id)->get()) == 0) {
            for ($i = 0; $i < 5; $i++) {
                $week = new Week();
                $week->week = $i + 1;
                $week->monthid = $this->id;
                $week->save();
            }
        }
    }

    /**
     * Returns all associated weeks
     * @return mixed
     */
    public function getWeeks() {
        return Week::where("monthid", "=", $this->id)->get();
    }
}

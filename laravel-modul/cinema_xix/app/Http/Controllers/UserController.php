<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Movie,
    Schedule,
    Branch
};

class UserController extends Controller
{
    public function schedule()
    {
        $branches = Branch::orderBy("name")->get();
        $schedule = Schedule::with("movie", "studio")->whereDate("start", ">", now())->orderBy("start")->whereHas("movie", function($q) {
            $q->groupBy("name", "price");
        })->limit(5)->get();

        return view("user.schedule", compact("schedule", "branches"));
    }

    public function search(Request $request)
    {
        $branch_id = $request->branch_id;
        $date = $request->date;

        $branches = Branch::orderBy("name")->get();
        $schedule = Schedule::with("movie", "studio")->whereDate("start", ">", now())
        ->when($branch_id, function($q) use ($branch_id) {
            $q->whereHas("studio", function($q2) use ($branch_id) {
                $q2->where("branch_id", $branch_id);
            });
        })->when($date, function($q) use ($date) {
            $q->whereDate("start", ">", $date);
        })
        ->orderBy("start")->whereHas("movie", function($q) {
            $q->groupBy("name", "price");
        })->get();

        return view("user.schedule", compact("schedule", "branches"));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\{
    Schedule,
    Movie,
    Studio
};
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $schedules = Schedule::latest()->get();

        $tableHeader = array_map(function($item) {
            return ucwords(str_replace("_id", "", $item));
        }, (new Schedule)->getFillable()); 
        return view('schedule.index', compact('schedules', 'index', 'tableHeader'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = \App\Models\Movie::all();
        $studios = \App\Models\Studio::all();

        return view('schedule.create', compact('movies', 'studios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'movie_id' => 'required',
            'studio_id' => 'required',
            'start' => 'required',
            'end' => 'required|after:start',
            'price' => 'required',
        ]);

        Schedule::create($data);
        return redirect()->route('schedule.index')->with('success', 'Schedule created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $movies = \App\Models\Movie::all();
        $studios = \App\Models\Studio::all();

        return view('schedule.create', compact('schedule', 'movies', 'studios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'movie_id' => 'required',
            'studio_id' => 'required',
            'start' => 'required',
            'end' => 'required|after:start',
            'price' => 'required',
        ]);

        $schedule->update($data);
        return redirect()->route('schedule.index')->with('success', 'Schedule updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Schedule deleted successfully');
    }

    public function getInfo(Request $request)
    {
        $start = $request->start;
        $movie = Movie::find($request->movie);
        $studio = Studio::find($request->studio);
        $day = Carbon::parse($start)->dayOfWeek;

        $end = date('Y-m-d H:i:s', strtotime($start) + $movie->minute_length * 60);
        $basic_price = intval($this->convertPrice($studio->basic_price));

        $price = match($day) {
            5 => $basic_price + intval($this->convertPrice($studio->additional_friday_price)),
            6 => $basic_price + intval($this->convertPrice($studio->additional_saturday_price)),
            0 => $basic_price + intval($this->convertPrice($studio->additional_sunday_price)),
            default => $basic_price
        };

        return response()->json([
            'end' => $end,
            'price' => $price
        ]);
    }

    public function convertPrice($price)
    {
        return trim(str_replace(",", "", explode('.', $price)[1]));
    }
}

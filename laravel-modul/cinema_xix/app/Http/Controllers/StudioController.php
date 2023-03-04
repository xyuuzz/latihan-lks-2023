<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\Branch;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = 1;
        $studios = Studio::latest()->get();
        

        return view("studio.index", compact("studios", "index"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::latest()->get();

        return view("studio.create", compact("branches"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // make validation for studios
        $data = $request->validate([
            "name" => "required",
            "basic_price" => "required",
            "branch_id" => "required",
            "additional_friday_price" => "required",
            "additional_saturday_price" => "required",
            "additional_sunday_price" => "required",
        ]);

        // store data
        Studio::create($data);
        return redirect("admin/studio")->with("success", "Studio created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function show(Studio $studio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(Studio $studio)
    {
        $branches = Branch::latest()->get();
        return view("studio.create", compact("studio", "branches"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studio $studio)
    {
        // make validation for studios
        $data = $request->validate([
            "name" => "required",
            "basic_price" => "required",
            "branch_id" => "required",
            "additional_friday_price" => "required",
            "additional_saturday_price" => "required",
            "additional_sunday_price" => "required",
        ]);

        // store data
        $studio->update($data);
        return redirect("admin/studio")->with("success", "Studio updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studio $studio)
    {
        $studio->delete();
        return redirect("admin/studio")->with("success", "Studio deleted successfully.");
    }
}

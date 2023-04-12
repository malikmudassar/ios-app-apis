<?php

namespace App\Http\Controllers;

use App\Models\spot;
use App\Http\Requests\StorespotRequest;
use App\Http\Requests\UpdatespotRequest;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorespotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorespotRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function show(spot $spot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function edit(spot $spot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatespotRequest  $request
     * @param  \App\Models\spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatespotRequest $request, spot $spot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function destroy(spot $spot)
    {
        //
    }
}

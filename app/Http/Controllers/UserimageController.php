<?php

namespace App\Http\Controllers;

use App\Models\Userimage;
use App\Http\Requests\StoreUserimageRequest;
use App\Http\Requests\UpdateUserimageRequest;

class UserimageController extends Controller
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
     * @param  \App\Http\Requests\StoreUserimageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserimageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Userimage  $userimage
     * @return \Illuminate\Http\Response
     */
    public function show(Userimage $userimage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Userimage  $userimage
     * @return \Illuminate\Http\Response
     */
    public function edit(Userimage $userimage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserimageRequest  $request
     * @param  \App\Models\Userimage  $userimage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserimageRequest $request, Userimage $userimage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Userimage  $userimage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userimage $userimage)
    {
        //
    }
}

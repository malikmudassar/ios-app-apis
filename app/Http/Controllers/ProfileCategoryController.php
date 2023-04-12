<?php

namespace App\Http\Controllers;

use App\Models\ProfileCategory;
use App\Http\Requests\StoreProfileCategoryRequest;
use App\Http\Requests\UpdateProfileCategoryRequest;

class ProfileCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreProfileCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfileCategory  $profileCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileCategory $profileCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfileCategory  $profileCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileCategory $profileCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileCategoryRequest  $request
     * @param  \App\Models\ProfileCategory  $profileCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileCategoryRequest $request, ProfileCategory $profileCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfileCategory  $profileCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileCategory $profileCategory)
    {
        //
    }
}

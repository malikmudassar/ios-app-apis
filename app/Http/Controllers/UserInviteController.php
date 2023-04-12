<?php

namespace App\Http\Controllers;

use App\Models\UserInvite;
use App\Http\Requests\StoreUserInviteRequest;
use App\Http\Requests\UpdateUserInviteRequest;

class UserInviteController extends Controller
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
     * @param  \App\Http\Requests\StoreUserInviteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserInviteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserInvite  $userInvite
     * @return \Illuminate\Http\Response
     */
    public function show(UserInvite $userInvite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserInvite  $userInvite
     * @return \Illuminate\Http\Response
     */
    public function edit(UserInvite $userInvite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserInviteRequest  $request
     * @param  \App\Models\UserInvite  $userInvite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserInviteRequest $request, UserInvite $userInvite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserInvite  $userInvite
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserInvite $userInvite)
    {
        //
    }
}

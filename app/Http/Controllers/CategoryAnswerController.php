<?php

namespace App\Http\Controllers;

use App\Models\CategoryAnswer;
use App\Http\Requests\StoreCategoryAnswerRequest;
use App\Http\Requests\UpdateCategoryAnswerRequest;

class CategoryAnswerController extends Controller
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
     * @param  \App\Http\Requests\StoreCategoryAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryAnswerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoryAnswer  $categoryAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryAnswer $categoryAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryAnswer  $categoryAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryAnswer $categoryAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryAnswerRequest  $request
     * @param  \App\Models\CategoryAnswer  $categoryAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryAnswerRequest $request, CategoryAnswer $categoryAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoryAnswer  $categoryAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryAnswer $categoryAnswer)
    {
        //
    }
}

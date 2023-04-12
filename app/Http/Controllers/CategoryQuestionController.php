<?php

namespace App\Http\Controllers;

use App\Models\Category_Question;
use App\Http\Requests\StoreCategory_QuestionRequest;
use App\Http\Requests\UpdateCategory_QuestionRequest;

class CategoryQuestionController extends Controller
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
     * @param  \App\Http\Requests\StoreCategory_QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory_QuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category_Question  $category_Question
     * @return \Illuminate\Http\Response
     */
    public function show(Category_Question $category_Question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category_Question  $category_Question
     * @return \Illuminate\Http\Response
     */
    public function edit(Category_Question $category_Question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategory_QuestionRequest  $request
     * @param  \App\Models\Category_Question  $category_Question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory_QuestionRequest $request, Category_Question $category_Question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category_Question  $category_Question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category_Question $category_Question)
    {
        //
    }
}

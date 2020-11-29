<?php

namespace App\Http\Controllers;

use App\Models\TherapyCase;
use Illuminate\Http\Request;

class TherapyCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TherapyCase::with('child')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TherapyCase  $therapyCase
     * @return \Illuminate\Http\Response
     */
    public function show(TherapyCase $case)
    {
        return $case->load(['child','users','goals','goals.activities']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TherapyCase  $therapyCase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TherapyCase $case)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TherapyCase  $therapyCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(TherapyCase $therapyCase)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\TherapyCaseResource;
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
        return TherapyCaseResource::collection(TherapyCase::with(['child','users'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'child_id'=>'required',
            'diagnosis' => 'required',
        ]);
        $case = TherapyCase::create($request->all());
        $case->users()->attach($request->user());
        return new TherapyCaseResource($case->child);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TherapyCase  $therapyCase
     * @return \Illuminate\Http\Response
     */
    public function show(TherapyCase $case)
    {
        return new TherapyCaseResource($case);
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

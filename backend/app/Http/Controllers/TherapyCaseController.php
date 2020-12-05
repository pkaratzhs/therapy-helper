<?php

namespace App\Http\Controllers;

use App\Http\Resources\TherapyCaseResource;
use App\Models\TherapyCase;
use Illuminate\Http\Request;

class TherapyCaseController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TherapyCase::class, 'case');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TherapyCaseResource::collection(auth()->user()->therapyCases);
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
            'name' => 'required',
            'age' => 'required',
            'diagnosis' => 'required',
        ]);
        $case = TherapyCase::create($request->all());
        $case->users()->attach($request->user());
        return new TherapyCaseResource($case->load('users'));
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
        $case->fill($request->all());
        $case->save();
        

        return new TherapyCaseResource($case);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TherapyCase  $case
     * @return \Illuminate\Http\Response
     */
    public function destroy(TherapyCase $case)
    {
        $case->delete();

        return response('deleted', 200);
    }
}

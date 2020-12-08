<?php

namespace App\Http\Controllers;

use App\Http\Resources\GoalResource;
use App\Models\Goal;
use Illuminate\Http\Request;
use App\Models\TherapyCase;

class GoalController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Goal::class, 'goal');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TherapyCase $case)
    {
        return GoalResource::collection($case->goals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TherapyCase $case)
    {
        $request->validate([
            'title' => 'required'
        ]);
    
        $goal = $case->goals()->create($request->all());
        return new GoalResource($goal);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goals  $goals
     * @return \Illuminate\Http\Response
     */
    public function show(TherapyCase $case, Goal $goal)
    {
        if ($case->findGoal($goal)) {
            return new GoalResource($goal);
        }
        return response()->json('', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goals  $goals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TherapyCase $case, Goal $goal)
    {
        if ($case->findGoal($goal)) {
            $goal->fill($request->all())->save();
            return new GoalResource($goal);
        }
        return response()->json('', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goals  $goals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Therapycase $case, Goal $goal)
    {
        if ($case->findGoal($goal)) {
            $goal->delete();
            return response()->json('deleted', 200);
        }
        return response()->json('', 404);
    }
}

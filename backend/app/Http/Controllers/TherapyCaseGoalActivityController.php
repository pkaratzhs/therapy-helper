<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Models\Goal;
use App\Models\GoalActivity;
use App\Models\TherapyCase;
use Illuminate\Http\Request;

//filter with my policy?
class TherapyCaseGoalActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */

    public function index(TherapyCase $case, Goal $goal)
    {
        $this->authorize('viewAnyActivityOfGoal', [Activity::class,$case,$goal]);
        return ActivityResource::collection($goal->activities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function attachActivityToGoal(TherapyCase $case, Goal $goal, Activity $activity)
    {
        $this->authorize('storeGoalActivity', [Activity::class,$goal,$case]);
        $goal->activities()->attach($activity->id);
        return new ActivityResource($activity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(TherapyCase $case, Goal $goal, Activity $activity)
    {
        $this->authorize('viewNestedActivity', [$activity,$goal,$case]);
        return new ActivityResource($activity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(TherapyCase $case, Goal $goal, Activity $activity)
    {
        $this->authorize('deleteGoalActivity', [$activity,$goal,$case]);
        $activity->goals()->detach($goal->id);
        return response('', 204);
    }
}

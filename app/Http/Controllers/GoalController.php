<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goals = Goal::orderBy('order')->get();
        $completed = Goal::where('completed', 1)->count();
        $percentage = round($completed / count($goals) * 100);

        return view('app.goal.index')->with([
            'goals' => $goals,
            'completed' => $completed,
            'percentage' => $percentage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.goal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGoalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'unique:goals', 'min:10', 'max:255'],
            'description' => ['required', 'min:10', 'max:512'],
            'completed' => ['boolean'],
        ]);

        Goal::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => intval($request->completed)
        ]);

        //return $this->index();
        return redirect()->route('app.goal.index')->with([
            'success' => '<b class="mr-1">' . htmlentities($request->title) . '</b>' . ' hozzáadva a bakancslistádhoz.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        return view('app.goal.show')->with([
            'goal' => $goal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        return view('app.goal.edit')->with([
            'goal' => $goal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGoalRequest  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'title' => ['required', 'min:10', 'max:255'],
            'description' => ['required', 'min:10', 'max:512'],
            'completed' => ['boolean'],
        ]);

        $goal->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => intval($request->completed)
        ]);

        return redirect()->route('goal.index')->with([
            'success' => '<b class="mr-1">' . htmlentities($request->title) . '</b>' . ' sikeresen módosítva.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $oldTitle = htmlentities($goal->title);
        $goal->deleteOrFail();
        return redirect()->route('app.goal.index')->with([
            'success' => '<b class="mr-1">' .  $oldTitle . '</b> sikeresen törölve.',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Goal::class);

        $goals = Goal::where('user_id', Auth::id())
            ->orderBy('order')
            ->get();

        $completed = Goal::where('user_id', Auth::id())
            ->where('completed', 1)
            ->count();

        $percentage = count($goals) ? round($completed / count($goals) * 100) : null;

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
        $this->authorize('create', Goal::class);

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
        $this->authorize('create', Goal::class);

        $request->validate([
            'title' => ['required', 'unique:goals', 'min:10', 'max:255'],
            'description' => ['required', 'min:10', 'max:255'],
            'completed' => ['boolean'],
        ]);

        Goal::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'completed' => intval($request->completed),
        ]);

        return redirect()->route('goal.index')->with([
            'notification' => [
                'message' => '<b class="mr-1">' . htmlentities($request->title) . '</b>' . ' hozzáadva a bakancslistádhoz.',
                'type'    => 'success'
            ]
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
        abort_unless(Gate::allows('view', $goal), 403);

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
        abort_unless(Gate::allows('update', $goal), 403);

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
        abort_unless(Gate::allows('update', $goal), 403);

        $request->validate([
            'title' => ['required', 'min:10', 'max:255'],
            'description' => ['required', 'min:10', 'max:255'],
            'completed' => ['boolean'],
        ]);

        $goal->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => intval($request->completed)
        ]);

        return redirect()->route('goal.index')->with([
            'notification' => [
                'message' => '<b class="mr-1">' . htmlentities($request->title) . '</b>' . ' sikeresen módosítva.',
                'type'    => 'success'
            ]
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
        abort_unless(Gate::allows('delete', $goal), 403);

        $oldTitle = htmlentities($goal->title);
        $goal->deleteOrFail();
        return redirect()->route('goal.index')->with([
            'notification' => [
                'message' => '<b class="mr-1">' .  $oldTitle . '</b> sikeresen törölve.',
                'type'    => 'success'
            ]
        ]);
    }
}

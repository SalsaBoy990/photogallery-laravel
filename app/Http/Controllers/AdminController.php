<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        return view('admin.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => ['required', 'string'],
            'role' => ['required', 'integer', 'min:1', 'max:2'],
            'email' => ['required', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $newUser = new User([
            'name' => htmlspecialchars($request->name),
            'email' => htmlspecialchars($request->email),
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'role' => intval($request->role), // 1 = admin, 2 = customer
            'remember_token' => Str::random(10),
        ]);

        $newUser->save();


        return redirect()->route('user.index')->with([
            'notification' => [
                'message' => '<b>"' . htmlspecialchars($request->name) . '"</b> nevű felhasználó sikeresen létrehozva.',
                'type'    => 'success'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $this->authorize('delete', User::class);
        abort_unless(Gate::allows('delete', $user), 403);

        $oldName = htmlentities($user->name);
        $user->deleteOrFail();

        return redirect()->route('user.index')->with([
            'notification' => [
                'message' => '<b class="mr-1">' .  $oldName . '</b> nevű felhasználó sikeresen törölve.',
                'type'    => 'success'
            ]
        ]);
    }
}

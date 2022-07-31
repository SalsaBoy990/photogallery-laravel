<?php

namespace App\Http\Controllers;

use App\Models\User;

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

        $users = User::orderBy('id', 'DESC')->paginate(10);

        return view('admin.index')->with([
            'users' => $users
        ]);
    }
}

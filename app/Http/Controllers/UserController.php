<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => ['required', 'string'],
            'role' => ['required', 'integer', 'min:1', 'max:2'],
            'sex' => ['required', 'string'],
            'email' => ['required', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $newUser = new User([
            'name' => htmlspecialchars($request->name),
            'email' => htmlspecialchars($request->email),
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'role' => intval($request->role), // 1 = admin, 2 = customer
            'sex' => htmlspecialchars($request->sex),
            'remember_token' => Str::random(10),
        ]);

        $newUser->save();


        return redirect()->route('admin.index')->with([
            'notification' => [
                'message' => __('The user <b class="mr-1 ml-1">":name"</b> successfully created.', ['name' => htmlentities($request->name)]),
                'type'    => 'success'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_unless(Gate::allows('view', $user), 403);

        return view('app.user.profile')->with(
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_unless(Gate::allows('update', $user), 403);

        return view('app.user.edit')->with([
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_unless(Gate::allows('update', $user), 403);

        $request->validate([
            'name' => ['required', 'max:100'],
            'short_bio' => ['required', 'max:255'],
            'avatar_image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:1024', 'dimensions:ratio=1/1'],
        ]);

        $avatarImage = $request->file('avatar_image');

        if ($avatarImage === null || !$avatarImage->isValid()) {
            $user->update([
                'name' => $request->name,
                'short_bio' => $request->short_bio,
            ]);
        } else {
            $userFolder = 'app/user/' . auth()->id();

            if (!is_dir(storage_path($userFolder))) {
                mkdir(storage_path($userFolder), 0775, true);
            }

            $imageFileName = time() . '_' . pathinfo($avatarImage->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';
            $avatarImagePath = storage_path($userFolder) . '/' . $imageFileName;

            $imageStoragePath = '/user/' . Auth::user()->id  . '/' . Auth::user()->avatar_image;
            if (Storage::exists($imageStoragePath)) {
                Storage::delete($imageStoragePath);
            }

            $image = Image::make($avatarImage);

            if ($image->width() > 512) {
                $image->resize(512, 512, function ($constraint) {
                    $constraint->aspectRatio();
                })
                    ->save($avatarImagePath, 85, 'jpg');
            } else {
                $image->save($avatarImagePath, 85, 'jpg');
            }

            $user->update([
                'name' => $request->name,
                'short_bio' => $request->short_bio,
                'avatar_image' => $imageFileName,
            ]);
        }

        return redirect()->route('user.show', Auth::user()->id)->with([
            'notification' => [
                'message' => __('You have updated your profile.'),
                'type'    => 'success'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $this->authorize('delete', User::class);
        abort_unless(Gate::allows('delete', $user), 403);

        $oldName = htmlentities($user->name);
        $user->deleteOrFail();

        return redirect()->route('admin.index')->with([
            'notification' => [
                'message' => __('The user <b class="mr-1 ml-1">":name"</b> successfully deleted.', ['name' => htmlentities($oldName)]),
                'type'    => 'success'
            ]
        ]);
    }

    public function changePassword(Request $request)
    {
        abort_unless(Gate::allows('update', auth()->user()), 403);

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'nullable|required_with:new_password_confirmation|string|confirmed',
        ]);

        # A régi jelszó ellenőrzése
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('error', __('Old password does not match!'));
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('user.show', Auth()->user()->id)->with([
            'notification' => [
                'message' => __('You have successfully changed your password.'),
                'type'    => 'success'
            ]
        ]);
    }
}

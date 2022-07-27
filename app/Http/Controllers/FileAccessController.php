<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileAccessController extends Controller
{
    public function serveCoverImage(Request $request)
    {
        if (Auth::user() && Auth::id() === intval($request->user)) {
            $path = explode('/', $request->getPathInfo());
            $yearMonthFolder = $path[4];
            // Here we don't use the Storage facade that assumes the storage/app folder
            // So filename should be a relative path inside storage to your file like 'app/userfiles/report1253.pdf'
            $filePath = storage_path('app/user/' . Auth::id() . '/coverimages/' . $yearMonthFolder . '/' . $request->file);
            return response()->file($filePath);
        } else {
            return abort('404');
        }
    }

    public function servePhoto(Request $request)
    {
        if (Auth::user() && Auth::id() === intval($request->user)) {
            $path = explode('/', $request->getPathInfo());
            $galleryFolder = $path[4];

            // Here we don't use the Storage facade that assumes the storage/app folder
            // So filename should be a relative path inside storage to your file like 'app/userfiles/report1253.pdf'
            $filePath = storage_path('app/user/' . Auth::id() . '/photos/' . $galleryFolder . '/' . $request->file);
            return response()->file($filePath);
        } else {
           return abort('404');
        }
    }


    public function serveUserAvatar(Request $request)
    {
        if (Auth::user() && Auth::id() === intval($request->user)) {
            // Here we don't use the Storage facade that assumes the storage/app folder
            // So filename should be a relative path inside storage to your file like 'app/userfiles/report1253.pdf'
            $filePath = storage_path('app/user/' . Auth::id() . '/' . $request->file);
            return response()->file($filePath);
        } else {
            return abort('404');
        }
    }
}

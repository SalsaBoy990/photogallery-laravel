<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class FileAccessController extends Controller
{
    public function serveCoverImage(Request $request)
    {
        return $this->serveImage($request, File::IMAGE_TYPES['cover']);
    }

    public function servePhoto(Request $request)
    {
        return $this->serveImage($request, File::IMAGE_TYPES['photo']);
    }

    public function serveUserAvatar(Request $request)
    {
        return $this->serveImage($request, File::IMAGE_TYPES['avatar']);
    }

    public function serveImage(Request $request, string $type)
    {
        if (Auth::user() && Auth::id() === intval($request->user) || Auth::user()->role === 'admin') {
            // Here we don't use the Storage facade that assumes the storage/app folder
            // So filename should be a relative path inside storage to your file like 'app/userfiles/report1253.pdf'
            $filePath = '';

            switch ($type) {
                case 'avatar':
                    $filePath = storage_path('app/user/' . $request->user . '/' . $request->file);
                    break;

                case 'photo':
                    $path = explode('/', $request->getPathInfo());
                    $galleryFolder = $path[4];
                    $filePath = storage_path('app/user/' . Auth::id() . '/photos/' . $galleryFolder . '/' . $request->file);
                    break;

                case 'cover':
                    $path = explode('/', $request->getPathInfo());
                    $yearMonthFolder = $path[4];
                    $filePath = storage_path('app/user/' . Auth::id() . '/coverimages/' . $yearMonthFolder . '/' . $request->file);
                    break;

                default:
                    break;
            }

            return response()->file($filePath);
        } else {
            return abort('404');
        }
    }
}

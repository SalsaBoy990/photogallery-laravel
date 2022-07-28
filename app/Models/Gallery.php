<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use App\Casts\HtmlSpecialCharsCast;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Gallery extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'thumbnail_image',
        'user_id',
    ];

    protected $casts = [
        'name'           => HtmlSpecialCharsCast::class,
        'description'    => CleanHtml::class,
    ];

    /**
     * Gallery has many photos
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Galleries belong to many tags
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * User has many galleries
     * 
     * @return @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createFoldersIfNotExist(string $userFolder, string $coverImagesFolder, string $coverImagesYearMonthFolder)
    {
        if (!is_dir(storage_path($userFolder))) {
            mkdir(storage_path($userFolder), 0775, true);
        }
        if (!is_dir(storage_path($coverImagesFolder))) {
            mkdir(storage_path($coverImagesFolder), 0775, true);
        }
        if (!is_dir(storage_path($coverImagesYearMonthFolder))) {
            mkdir(storage_path($coverImagesYearMonthFolder), 0775, true);
        }
    }

    public static function checkIfCoverImageExists(int $userId, string $image)
    {
        $imageStoragePath = '/user/' . $userId . '/coverimages/' . $image;
        return Storage::exists($imageStoragePath);
    }


    public static function deleteCoverImage(int $userId, string $image)
    {
        $imageStoragePath = '/user/' . $userId . '/coverimages/' . $image;
        if (Storage::exists($imageStoragePath)) {
            Storage::delete($imageStoragePath);
        }
    }

    public static function generateCoverImagePaths(bool $isValid, $coverImage, int $userId, string $coverImagesYearMonthFolder)
    {
        if (!$isValid) {
            $imageFileName = 'placeholder.jpg';
            $thumbnailImageFileName = 'placeholder.jpg';
        } else {
            // with jpg extension (it will be converted to jpg in case of other extensions)
            $imageFileName = $userId . '_' . time() . '_' . pathinfo($coverImage->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';
            $thumbnailImageFileName = $userId . '_' . time() . '_' . pathinfo($coverImage->getClientOriginalName(), PATHINFO_FILENAME) . '_thumbnail.jpg';
        }

        $imagePath = storage_path($coverImagesYearMonthFolder) . '/' . $imageFileName;
        $thumbnailImagePath = storage_path($coverImagesYearMonthFolder) . '/' . $thumbnailImageFileName;
        //$imageFileName->move(storage_path('app/user/' . $request->user->id . '/coverimages/' . $currentDate), $coverImageName);

        return [
            'imagePath' => $imagePath,
            'thumbnailImagePath' => $thumbnailImagePath,
            'imageFileName' => $imageFileName,
            'thumbnailImageFileName' => $thumbnailImageFileName,
        ];
    }
}

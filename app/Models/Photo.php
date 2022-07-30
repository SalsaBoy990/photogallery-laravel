<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Casts\HtmlSpecialCharsCast;
use Illuminate\Support\Facades\Storage;

class Photo extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'full_image',
        'thumbnail_image',
        'gallery_id'
    ];

    protected $casts = [
        'title'          => HtmlSpecialCharsCast::class,
        'description'    => HtmlSpecialCharsCast::class,
        'location'       => HtmlSpecialCharsCast::class
    ];


    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    /**
     * @param string $userFolder
     * @param string $photosFolder
     * @param string $galleryFolder
     * 
     * @return void
     */
    public static function createFoldersIfNotExist(string $userFolder, string $photosFolder, string $galleryFolder): void
    {
        if (!is_dir(storage_path($userFolder))) {
            mkdir(storage_path($userFolder), 0775, true);
        }

        if (!is_dir(storage_path($photosFolder))) {
            mkdir(storage_path($photosFolder), 0775, true);
        }

        if (!is_dir(storage_path($galleryFolder))) {
            mkdir(storage_path($galleryFolder), 0775, true);
        }
    }

    /**
     * @param int $userId
     * @param int $galleryId
     * @param string $image
     * 
     * @return bool
     */
    public static function checkIfImageExists(int $userId, int $galleryId, string $image): bool
    {
        $imageStoragePath = '/user/' . $userId . '/photos/' . $galleryId . '/' . $image;
        return Storage::exists($imageStoragePath);
    }


    /**
     * @param int $userId
     * @param int $galleryId
     * @param string $image
     * 
     * @return void
     */
    public static function deleteImage(int $userId, int $galleryId, string $image): void
    {
        $imageStoragePath = '/user/' . $userId . '/photos/' . $galleryId . '/' . $image;
        if (Storage::exists($imageStoragePath)) {
            Storage::delete($imageStoragePath);
        }
    }

    /**
     * @param mixed $image
     * @param int $userId
     * @param string $galleryFolder
     * 
     * @return array
     */
    public static function generateImagePaths($image, int $userId, string $galleryFolder): array
    {
        // with jpg extension (it will be converted to jpg in case of other extensions)
        $imageFileName = $userId . '_' . time() . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '.jpg';
        $thumbnailImageFileName = $userId . '_' . time() . '_' . pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME) . '_thumbnail.jpg';

        $imagePath = storage_path($galleryFolder) . '/' . $imageFileName;
        $thumbnailImagePath = storage_path($galleryFolder) . '/' . $thumbnailImageFileName;

        return [
            'imagePath' => $imagePath,
            'thumbnailImagePath' => $thumbnailImagePath,
            'imageFileName' => $imageFileName,
            'thumbnailImageFileName' => $thumbnailImageFileName,
        ];
    }
}

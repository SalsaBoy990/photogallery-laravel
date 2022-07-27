<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class BaseModel extends Model
{
    use HasFactory;

    public static function queryByUserId($query)
    {
        $query->where('user_id', Auth()->id());
    }

    public static function queryByUserIdCallback($q)
    {
        return function ($q) {
            BaseModel::queryByUserId($q);
        };
    }

    public static function saveImage(string $inputImage, string $imagePath, string $thumbnailImagePath)
    {
        $image = Image::make($inputImage);
        $imageWidth = $image->width();
        $imageHeight = $image->height();

        if ($imageWidth > $imageHeight || $imageHeight > $imageWidth) {
            // Landscape & portrait will have a width with a maximum of 2500pxs
            ($imageWidth > 2500) ?
                $image->resize(2500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($imagePath, 75, 'jpg')
                ->resize(700, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnailImagePath, 80, 'jpg')
                :
                $image->save($imagePath, 75, 'jpg')
                ->resize(700, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($thumbnailImagePath, 80, 'jpg');
        } else {
            // Square
            ($imageWidth > 2500) ?
                $image->resize(2500, 2500, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($imagePath, 75, 'jpg')
                ->resize(700, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnailImagePath, 80, 'jpg')
                :
                $image->save($imagePath, 75, 'jpg')
                ->resize(700, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($thumbnailImagePath, 80, 'jpg');
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

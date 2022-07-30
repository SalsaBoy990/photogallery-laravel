<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * Image types
     * 
     * @var array
     */
    public const IMAGE_TYPES = [
        'avatar' => 'avatar',
        'cover' => 'cover',
        'photo' => 'photo',
    ];
}

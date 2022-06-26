<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'image',
        'gallery_id',
        'owner_id',
    ];


    public function galleries()
    {
        return $this->belongsTo(Gallery::class);
    }
}

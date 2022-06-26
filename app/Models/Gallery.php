<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use Mews\Purifier\Casts\CleanHtmlInput;
use Mews\Purifier\Casts\CleanHtmlOutput;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'owner_id',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    protected $casts = [
        'description'    => CleanHtmlInput::class, // cleans when setting the value
    ];
}

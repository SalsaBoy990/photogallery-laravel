<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use App\Casts\HtmlEntitiesCast;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'image',
        'gallery_id'
    ];


    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    protected $casts = [
        'title'          => HtmlEntitiesCast::class,
        'description'    => CleanHtml::class,
        'location'       => CleanHtml::class
    ];
}

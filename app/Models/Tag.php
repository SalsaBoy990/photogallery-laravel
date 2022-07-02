<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use App\Casts\HtmlEntitiesCast;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        //'location',
    ];

    protected $casts = [
        'name'          => HtmlEntitiesCast::class,
        'description'    => CleanHtml::class,
        //'location'       => CleanHtml::class,
    ];

    /**
     * Tags belong to many galleries
     * 
     * @return @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function galleries()
    {
        return $this->belongsToMany(Gallery::class);
    }
}

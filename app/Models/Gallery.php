<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use App\Casts\HtmlEntitiesCast;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover_image',
        'user_id',
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

    protected $casts = [
        'name'           => HtmlEntitiesCast::class,
        'description'    => CleanHtml::class,
    ];
}

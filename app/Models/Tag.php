<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mews\Purifier\Casts\CleanHtml;
use App\Casts\HtmlEntitiesCast;
use App\Models\BaseModel;
use App\Casts\HtmlSpecialCharsCast;

class Tag extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected $casts = [
        'name'           => HtmlSpecialCharsCast::class,
        'description'    => CleanHtml::class,
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

    /**
     * Galleries belong to a specific tag
     * 
     * @return @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fiteredGalleries()
    {
        return $this->belongsToMany(Gallery::class)->wherePivot('tag_id', $this->id)->orderBy('updated_at', 'DESC');
    }

    /**
     * User has many tags
     * 
     * @return @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get tags with the galleries belonging to them (for user)
     * 
     * @return [type]
     */
    public static function getTagWithItsGalleries(Tag $tag, int $galleriesPerPage = 3)
    {
        return $tag->fiteredGalleries()
            ->where('user_id', Auth()->id())
            ->orderBy('created_at', 'DESC')
            ->paginate($galleriesPerPage);
    }

    /**
     * Get the galleries belonging to the tags (for user)
     * 
     * @return [type]
     */
    public static function getGalleriesFilteredByTag()
    {
        $callback = function ($query) {
            Tag::queryByUserId($query);
        };

        return Tag::whereRelation('galleries', 'user_id', Auth()->id())->with(['galleries' => $callback])->get();
    }
}

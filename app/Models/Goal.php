<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;
use App\Casts\HtmlSpecialCharsCast;

class Goal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'completed',
        'image',
        'order',
    ];

    protected $casts = [
        'title'          => HtmlSpecialCharsCast::class,
        'description'    => CleanHtml::class,
    ];
}

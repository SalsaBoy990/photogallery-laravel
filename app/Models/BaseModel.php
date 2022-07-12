<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

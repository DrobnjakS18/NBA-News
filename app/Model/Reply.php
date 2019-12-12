<?php

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    public function comment()
    {
        return $this->belongsTo('NbaNews\Model\Comment','comment_id');
    }

    public function user()
    {
        return $this->belongsTo('NbaNews\Model\Users','user_id');
    }
}

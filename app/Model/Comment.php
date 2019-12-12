<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/6/2019
 * Time: 11:37 PM
 */

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

use mysql_xdevapi\Exception;

class Comment extends Model
{

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class,'user_id');
    }



}

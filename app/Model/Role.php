<?php

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";
    protected $primaryKey = "id_role";


    public function users()
    {
        return $this->hasMany('NbaNews\Model\Users');
    }
}

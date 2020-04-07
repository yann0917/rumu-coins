<?php

namespace App\Models;


class Group extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function config()
    {
        return $this->belongsTo(GroupConfig::class, 'config_id', 'id');
    }

    public function goods()
    {
        return $this->belongsTo(GroupCoin::class, 'goods_id', 'id');
    }
}

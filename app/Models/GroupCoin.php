<?php

namespace App\Models;


class GroupCoin extends BaseModel
{
    protected $table = 'group_coins';

    protected $fillable=['group_id', 'sequence', 'sn', 'category', 'score', 'sn_no', 'low_price', 'top_price'];

    public function getTopPrice(array $ids)
    {
        return $this->whereIn('id', $ids)->pluck('top_price', 'id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'goods_id', 'id');
    }
}

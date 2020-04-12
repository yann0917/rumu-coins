<?php

namespace App\Models;


class GroupCoin extends BaseModel
{
    protected $table = 'group_coins';

    protected $fillable=['group_id', 'sn', 'category', 'score', 'sn_no', 'low_price', 'top_price'];
}

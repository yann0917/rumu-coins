<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupCoin extends Model
{
    use SoftDeletes;
    use HasDateTimeFormatter;

    protected $table = 'group_coins';
    protected $fillable=['group_id', 'sn', 'category', 'score', 'sn_no', 'low_price', 'top_price'];
}

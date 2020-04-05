<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupConfig extends Model
{
    use SoftDeletes;
    use HasDateTimeFormatter;

    protected $table = 'group_configs';

    /**
     * 一对多
     *
     * @return void
     */
    public function coins()
    {
        return $this->hasMany(GroupCoin::class, 'group_id', 'id');
    }
}

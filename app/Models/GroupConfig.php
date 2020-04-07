<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupConfig extends BaseModel
{
    protected $table = 'group_configs';

    /**
     * 一对多
     *
     * @return HasMany
     */
    public function coins()
    {
        return $this->hasMany(GroupCoin::class, 'group_id', 'id');
    }
}

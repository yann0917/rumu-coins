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
        return $this->belongsTo(GroupConfig::class, 'group_id', 'id');
    }

    public function goods()
    {
        return $this->belongsTo(GroupCoin::class, 'goods_id', 'id');
    }

    public function index(int  $limit, int $user_id)
    {
        $list = $this->with(['config', 'goods'])
            ->where('user_id', '=', $user_id)
            ->orderBy('group_id', 'desc')
            ->paginate($limit);
        $response = [
            'current_page' => $list->currentPage(),
            'list' =>  $list->items(),
            'total' => $list->total()
        ];

        return $response;
    }
}

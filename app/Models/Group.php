<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

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

    public function userGroup(int  $limit, int $user_id)
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

    public function store(array $params)
    {
        $data = $this->updateOrCreate([
            'user_id' => $params['user_id'],
            'group_id' => $params['group_id'],
            'goods_id' => $params['goods_id']
        ],
            ['price' => $params['price']]);
        return $data;
    }

    /**
     * 获取当前出价
     *
     * @param int $goods_id
     * @return int
     */
    public function getCurrentPrice(int $goods_id):int
    {
        $price = $this->select(DB::Raw('max(price) as price'))
            ->where([['goods_id', '=', $goods_id]])->first();
        return  $price->price ?? 0;
    }
}

<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;

class Group extends BaseModel
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 2;

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

    public function userGroup(int $limit, int $user_id)
    {
        $list = $this->with(['config', 'goods'])
            ->where('user_id', '=', $user_id)
            ->orderBy('group_id', 'desc')
            ->paginate($limit);
        $response = [
            'current_page' => $list->currentPage(),
            'list' => $list->items(),
            'total' => $list->total(),
        ];
        $config = new GroupConfig();
        foreach ($response['list'] as &$item) {
            $group_status = $config->getGroupStatus($item->config->start_at, $item->config->end_at);
            // 0-竞价中,1-成功,2-失败
            $item->bid_status = 0;
            if ($group_status == 1) {
                $item->bid_status = 0;
            } elseif ($group_status == 2) {
                if ($item->status == 1) {
                    $item->bid_status = 1;
                } else {
                    $item->bid_status = 2;
                }
            }
        }

        return $response;
    }

    public function store(array $params)
    {
        return DB::transaction(function () use ($params) {
            $data = $this->updateOrCreate([
                'user_id' => $params['user_id'],
                'group_id' => $params['group_id'],
                'goods_id' => $params['goods_id']],
                [
                    'price' => $params['price'],
                    'status' => self::STATUS_SUCCESS,
                ]);

            $this->where([
                ['group_id', '=', $params['group_id']],
                ['goods_id', '=', $params['goods_id']],
                ['price', '<', $params['price']],
            ])->update(['status' => self::STATUS_FAILED]);
            return $data;
        });
    }

    public function getListByUserId(int $user_id, int $group_id)
    {
        return $this->with('goods')->where([['user_id', '=', $user_id],
            ['group_id', '=', $group_id]])->get();
    }

    /**
     * 获取当前竞拍成功的用户信息
     *
     * @param int $goods_id
     * @return mixed
     */
    public function getCurrentUser(int $goods_id)
    {
        return $this->select('users.id as user_id','users.nickname', 'groups.price')
            ->leftJoin('users', 'users.id', '=', 'groups.user_id')
            ->where([['goods_id', '=', $goods_id], ['groups.status', '=', self::STATUS_SUCCESS]])
            ->first();
    }

    /**
     * 获取当前出价
     *
     * @param int $goods_id
     * @return int
     */
    public function getCurrentPrice(int $goods_id): int
    {
        $price = $this->select(DB::Raw('max(price) as price'))
            ->where([['goods_id', '=', $goods_id]])->first();
        return $price->price ?? 0;
    }
}

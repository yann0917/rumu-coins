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
    public function goods()
    {
        return $this->hasMany(GroupCoin::class, 'group_id', 'id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'group_id', 'id');
    }

    public function show(int $group_id)
    {
        $detail = $this->where('id', $group_id)->first()->toArray();
        if (isset($detail['id'])) {
            $detail['status'] = $this->getGroupStatus($detail['start_at'], $detail['end_at']);
        }
        return $detail;
    }

    /**
     * 获取最近一个小时后开始或者正在进行中的的团购
     *
     * @return array
     */
    public function getLatestGroup()
    {
        $now = date('Y-m-d H:i:s');
        $detail = $this->where([['start_at', '<=', $now], ['end_at', '>', $now]])
            ->orWhere([['start_at', '>=', $now], ['start_at', '<=', date('Y-m-d H:i:s', strtotime('+1 Hour'))]])
            ->orderBy('issue', 'desc')->first();
        if (isset($detail['id'])) {
            $detail = $detail->toArray();
            $detail['status'] = $this->getGroupStatus($detail['start_at'], $detail['end_at']);
        }
        return $detail;
    }

    public function getLatestGroupGoods(int $limit, string $category, int $user_id = 0)
    {
        $config = $this->getLatestGroup();
        $list = $this->getGroupGoods($config['id'], $limit, $category);
        if ($user_id > 0 ) {
            $list['joined'] = $this->myJoined($user_id, $config['id']);
        }
        return $list;
    }

    /**
     * 获取团购商品
     *
     * @param int    $group_id
     * @param int    $limit
     * @param string $category
     * @return array
     */
    public function getGroupGoods(int $group_id, int $limit, string $category)
    {
        $list = (new GroupCoin())->where([['group_id', '=', $group_id], ['category', '=', $category]])
            ->paginate($limit);
        $response = [
            'current_page' => $list->currentPage(),
            'list' => $list->items(),
            'total' => $list->total(),
        ];
        $group = new Group();
        foreach ($response['list'] as &$item) {
            $item['bid'] = $group->getCurrentUser($item['id']) ?? (object)[];
        }
        return $response;
    }

    /**
     * 获取分类
     *
     * @param int $group_id
     * @return array
     */
    public function getGroupCategory(int $group_id = 0)
    {
        $config = $this->show($group_id);
        $config['category'] = (new GroupCoin())->select('category')
            ->where('group_id', $group_id)
            ->groupBy('category')->get();
        return $config;
    }

    public function myJoined(int $user_id, $group_id)
    {
        // 我的
        $group = new Group();
        $list = $group->getListByUserId($user_id, $group_id);
        foreach ($list as &$item) {
            $item['goods']['bid'] = $group->getCurrentUser($item['goods_id']) ?? (object)[];
        }
        return $list;
    }

    /**
     * 转换团购状态
     *
     * @param string $start_at 开始时间
     * @param string $end_at   结束时间
     * @return int 0-未开始，1-进行中，2-已结束
     */
    public function getGroupStatus(string $start_at, string $end_at): int
    {
        $now = date('Y-m-d H:i:s');
        if ($now >= $start_at && $now < $end_at) {
            $status = 1;
        } elseif ($now >= $end_at && $now >= $start_at) {
            $status = 2;
        } else {
            $status = 0;
        }
        return $status;
    }

    /**
     * 商品按类型组合数据
     *
     * @param array $goods
     * @return array
     */
    public function goodsSubGroup(array $goods): array
    {
        $group = new Group();
        $temp_category = [];
        $temp = [];
        foreach ($goods as $key => $item) {
            $temp_category[$item['category']][] = $item;
        }
        foreach ($temp_category as $key => &$item) {
            $temp[$key]['category'] = $key;
            foreach ($item as &$item2) {
                $item2['bid'] = $group->getCurrentUser($item2['id']) ?? (object)[];
            }
            $temp[$key]['goods'] = $item;
        }
        return array_values($temp);
    }
}

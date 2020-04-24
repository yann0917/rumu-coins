<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

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

    public function historyList(int $page, int $limit)
    {
        $cache_key = 'group:history:'. $page .':'. $limit;
        $cache =  Cache::get($cache_key);
        if ($cache) {
            return $cache;
        }
        $list = $this->where('end_at', '<=', date('Y-m-d H:i:d'))
            ->orderBy('issue', 'desc')
            ->paginate($limit);
        $response = [
            'current_page' => $list->currentPage(),
            'list' =>  $list->items(),
            'total' => $list->total()
        ];
        Cache::put($cache_key, $response, 300);

        return $response;
    }

    /**
     * 获取最近一个小时后开始或者正在进行中的的团购
     *
     * @param bool $is_advance 是否提前参与
     * @return array
     */
    public function getLatestGroup(bool $is_advance = false)
    {
        if ($is_advance) {
            $key = 'group:latest:advance';
            $start_at = 'advance_start_at';
        } else {
            $key = 'group:latest';
            $start_at = 'start_at';
        }
        $cache = Cache::get($key);

        if ($cache) {
            $cache['status'] = $this->getGroupStatus($cache[$start_at], $cache['end_at']);
            return  $cache;
        }
        $now = date('Y-m-d H:i:s');
        $detail = $this->where([[$start_at, '<=', $now], ['end_at', '>', $now]])
            ->orWhere([[$start_at, '>=', $now], ['advance_start_at', '<=', date('Y-m-d H:i:s', strtotime('+1 Hour'))]])
            ->orderBy('issue', 'desc')->first();
        if (isset($detail['id'])) {
            $detail = $detail->toArray();
            // 开始时间替换掉
            $detail['start_at'] = $detail[$start_at];
            $detail['status'] = $this->getGroupStatus($detail['advance_start_at'], $detail['end_at']);
            $ttl = strtotime($detail['end_at']) - time();
            Cache::put($key, $detail, $ttl);
        }
        return $detail;
    }

    public function getLatestGroupGoods(int $limit, string $category, int $user_id = 0)
    {
        // 判断用户是否可提前竞价
        if ($user_id > 0 ) {
            $has_advance = (new User())->userHasAdvance($user_id);
            $config = $has_advance ? $this->getLatestGroup(true) : $this->getLatestGroup();
            $list = $this->getGroupGoods($config['id'], $limit, $category);
            $list['joined'] = $this->myJoined($user_id, $config['id']);
        } else {
            $config = $this->getLatestGroup();
            $list = $this->getGroupGoods($config['id'], $limit, $category);
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
        $cache_key = 'group:category:'. $group_id;
        $cache = Cache::get($cache_key);
        if ($cache) {
            $cache['status'] = $this->getGroupStatus($cache['start_at'], $cache['end_at']);
            return $cache;
        }
        $config = $this->show($group_id);
        $config['category'] = (new GroupCoin())->select('category')
            ->where('group_id', $group_id)
            ->groupBy('category')->get()->toArray();
        Cache::put($cache_key, $config, $this->ttl);
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
}

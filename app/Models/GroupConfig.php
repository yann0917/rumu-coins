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

    /**
     * 获取最近一个小时后开始或者正在进行中的的团购
     *
     * @return array
     */
    public function getLatestGroup()
    {
        $now = date('Y-m-d H:i:s');
        $detail = $this->with(['goods'])
            ->where([['start_at' ,'<=', $now],['end_at' , '>', $now]])
            ->orWhere([['start_at' ,'>=', $now], ['start_at' ,'<=', date('Y-m-d H:i:s', strtotime('+1 Hour'))]])
            ->orderBy('issue', 'desc')->first()->toArray();

        if (isset($detail['id'])) {
            $detail['status'] = $this->getGroupStatus($detail['start_at'], $detail['end_at']);
            $detail['goods'] = $this->goodsSubGroup($detail['goods'] );
        }
        return $detail;
    }

    /**
     * 转换团购状态
     *
     * @param string $start_at 开始时间
     * @param string $end_at 结束时间
     * @return int 0-未开始，1-进行中，2-已结束
     */
    public function getGroupStatus(string $start_at, string $end_at):int
    {
        $now = date('Y-m-d H:i:s');
        if ( $now >= $start_at && $now < $end_at) {
            $status = 1;
        } elseif ($now >= $end_at && $now >= $start_at) {
            $status = 2;
        } else {
            $status = 0;
        }
        return  $status;
    }

    /**
     * 商品按类型组合数据
     *
     * @param array $goods
     * @return array
     */
    public function goodsSubGroup(array $goods):array
    {
        $temp_category = [];
        $temp = [];
        foreach ($goods as $key => $item) {
            $temp_category[$item['category']][] = $item;
        }
        foreach ($temp_category as $key => $item) {
            $temp[$key]['category'] = $key;
            $temp[$key]['goods'] = $item;
        }
        return  array_values($temp);
    }
}

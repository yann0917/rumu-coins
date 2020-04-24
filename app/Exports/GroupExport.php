<?php

namespace App\Exports;

use App\Models\GroupCoin;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GroupExport implements FromQuery,WithHeadings,WithMapping
{
    protected $group_id;
    public function __construct(int $group_id)
    {
        $this->group_id = $group_id;
    }

    public function query()
    {
        return GroupCoin::query()
            ->leftJoin('groups', 'group_coins.id', '=', 'groups.goods_id')
            ->leftJoin('users', 'groups.user_id', '=', 'users.id')
            ->where('group_coins.group_id', $this->group_id);
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
       return [
           '序号',
           '号码',
           '分类',
           '分数',
           '证书号',
           '起步价',
           '封顶价',
           '出价人昵称',
           '出价人头像',
           '出价金额'
       ];
    }

    /**
     * @var GroupCoin $groupCoin
     * @return array
     */
    public function map($groupCoin): array
    {

        return [
            $groupCoin->sequence,
            $groupCoin->sn,
            $groupCoin->category,
            $groupCoin->score,
            $groupCoin->sn_no,
            $groupCoin->low_price * 0.01,
            $groupCoin->top_price * 0.01,
            $groupCoin->nickname,
            $groupCoin->avatar,
            $groupCoin->price * 0.01
        ];
    }
}

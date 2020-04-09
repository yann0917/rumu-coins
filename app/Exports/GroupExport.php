<?php

namespace App\Exports;

use App\Models\Group;
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
        return Group::query()->with(['user', 'goods'])->where('group_id', $this->group_id);
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
       return [
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
     * @var Group $group
     * @return array
     */
    public function map($group): array
    {
        return [
            $group->goods->sn,
            $group->goods->category,
            $group->goods->score,
            $group->goods->sn_no,
            $group->goods->low_price * 0.01,
            $group->goods->top_price * 0.01,
            $group->user->nickname,
            $group->user->avatar,
            $group->price * 0.01
        ];
    }
}

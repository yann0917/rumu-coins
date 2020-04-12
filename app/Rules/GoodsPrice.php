<?php

namespace App\Rules;

use App\Models\GroupCoin;
use Illuminate\Contracts\Validation\Rule;

class GoodsPrice implements Rule
{
    protected $goods_id;
    /**
     * Create a new rule instance.
     *
     * @param int $goods_id
     * @return void
     */
    public function __construct(int $goods_id)
    {
        $this->goods_id = $goods_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $goods = GroupCoin::query()->where('id', $this->goods_id)->first();
        if ($goods->low_price > $value || $goods->top_price < $value) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '出价区间不正确';
    }
}

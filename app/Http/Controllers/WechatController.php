<?php

namespace App\Http\Controllers;

use App\Models\Wechat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Wechat as WechatResource;

class WechatController extends BaseController
{
    public $wechat;

    public function __construct(Request $request, Wechat $wechat)
    {
        parent::__construct($request);
        $this->wechat = $wechat;
    }

    /**
     * 展示微信号和二维码
     *
     * @return JsonResponse
     */
    public function show()
    {
        $data = $this->wechat
            ->select('wechat_account', 'qrcode')
            ->first();
        return $this->success(WechatResource::make($data));
    }
}

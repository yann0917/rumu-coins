<?php

namespace App\Http\Controllers;

use App\Models\Wechat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Wechat as WechatResource;

/**
 * @group 微信 management
 * APIs for managing 微信配置
 */
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
     * @response {
     *      "code": 1,
     *      "message": "",
     *      "data": {
     *          "wechat_account": "yable",
     *          "qrcode": "http://rumu.top/images/81daa075b84e3825d897f6e5543cab2d.jpeg"
     *      }
     * }
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

<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Exceptions\Errors;
use App\Models\GroupConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 往期团购
 *
 * APIs for managing 往期团购
 */
class GroupBuyingController extends BaseController
{
    /** @var GroupConfig */
    protected $groupConfig;

    public function __construct(Request $request, GroupConfig $groupConfig)
    {
        $this->groupConfig = $groupConfig;
        parent::__construct($request);
    }

    /**
     * 往期团购列表
     *
     * @queryParam page 页码 默认 1
     * @queryParam limit 每页条数 默认15
     * @responseFile responses/history.list.get.json
     * @return JsonResponse
     */
    public function index()
    {
        $limit = $this->request->get('limit', 15);
        $list = $this->groupConfig
            ->where('end_at', '<=', date('Y-m-d H:i:d'))
            ->orderBy('issue', 'desc')
            ->paginate($limit);
        $response = [
            'current_page' => $list->currentPage(),
            'list' =>  $list->items(),
            'total' => $list->total()
        ];
        return $this->success($response);
    }


    /**
     * 往期团购详情
     *
     * @urlParam id required 团购 ID
     * @queryParam   page required string  页码
     * @queryParam   limit required string  每页展示数量，默认15
     * @queryParam   category required string 商品分类
     * @responseFile responses/history.get.json
     * @param $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function show($id)
    {
        $limit = $this->request->get('limit', 15);
        $category = $this->request->get('category', '');
        if ($category == '') {
            throw new ApiException(Errors::ERR_PARAM);
        }
        $detail = $this->groupConfig->getGroupGoods($id, $limit, $category);

        return $this->success($detail);
    }
}

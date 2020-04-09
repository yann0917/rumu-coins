<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Exceptions\Errors;
use App\Models\Group;
use App\Models\GroupConfig;
use App\Models\User;
use App\Rules\GoodsPrice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

/**
 * @group 团购
 * APIs for managing 团购
 */
class GroupController extends BaseController
{
    public $group;
    public $groupConfig;
    public $user;

    public function __construct(
        Request $request,
        Group $group,
        GroupConfig $groupConfig,User $user
    )
    {
        parent::__construct($request);
        $this->group = $group;
        $this->groupConfig = $groupConfig;
        $this->user = $user;
    }

    /**
     * 获取最近一个小时后开始或者正在进行中的的团购
     *
     * @return JsonResponse
     */
    public function index()
    {
        $detail = $this->groupConfig->getLatestGroup();
        return $this->success($detail);
    }

    /**
     * 我参与的团购
     *
     * @queryParam page 页码 默认 1
     * @queryParam limit 每页条数 默认15
     * @return JsonResponse
     */
    public function userGroup()
    {
        $user_id = 1;
        $limit = $this->request->get('limit', 15);
        $list = $this->group->userGroup($limit, $user_id);
        return $this->success($list);
    }
    /**
     * 参与竞价
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function store()
    {
        $params = $this->request->all();
        $validator = Validator::make($params, [
            'goods_id'=>'required|int|bail',
            'group_id' => 'required|int|bail',
            'price' => ['required', 'int', new GoodsPrice($params['goods_id'])]
        ]);

        if ($validator->fails()) {
            $errs = $validator->errors()->getMessages();
            $errMsg = '';
            foreach ($errs as $key => $err) {
                if ($key == 'price') {
                    $errMsg = Arr::first($err);
                    break;
                }
            }
            throw new ApiException(Errors::ERR_PARAM, $errMsg);
        }
        $user_id = 1;
        $user = $this->user->where('id', $user_id)->first();
        if ($user->status == 0) {
            throw new ApiException(Errors::ERR_USER_BLOCK);
        }

        $currentPrice = $this->group->getCurrentPrice($params['goods_id']);
        if ($params['price'] <= $currentPrice) {
            throw new ApiException(Errors::ERR_GROUP_BID_FAILED);
        }
        $res = $this->group->store($params);
        return  $this->success($res);
    }


    /**
     * @param int $goods_id 商品 ID
     * @return JsonResponse
     */
    public function currentPrice(int $goods_id)
    {
        $price = $this->group->getCurrentPrice($goods_id);
        return $this->success($price);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

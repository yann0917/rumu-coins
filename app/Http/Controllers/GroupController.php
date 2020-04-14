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
        GroupConfig $groupConfig, User $user
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
     * @queryParam   page required string  页码
     * @queryParam   limit required string  每页展示数量，默认15
     * @queryParam   category required string 商品分类
     * @responseFile responses/group.get.json
     * @return JsonResponse
     * @throws ApiException
     */
    public function index()
    {
        $limit = $this->request->get('limit', 15);
        $category = $this->request->get('category', '');
        if ($category == '') {
            throw new ApiException(Errors::ERR_PARAM);
        }
        $user_id = 2;
        $detail = $this->groupConfig->getLatestGroupGoods($limit, $category, $user_id);
        return $this->success($detail);
    }

    /**
     * 获取团购分类
     *
     * @urlParam     group_id  团购 ID，不传则为当前团购的ID
     * @responseFile responses/category.get.json
     * @param int $group_id
     * @return JsonResponse
     */
    public function category(int $group_id = 0)
    {
        if (!$group_id) {
            $config = $this->groupConfig->getLatestGroup();
            $group_id = $config['id'];
        }

        $category = (object)[];
        if ($group_id) {
            $category = $this->groupConfig->getGroupCategory($group_id);
        }
        return $this->success($category);
    }

    /**
     * 我参与的团购
     *
     * @queryParam   page 页码 默认 1
     * @queryParam   limit 每页条数 默认15
     * @responseFile responses/my.group.get.json
     * @return JsonResponse
     */
    public function userGroup()
    {
        $user_id = 2;
        $limit = $this->request->get('limit', 15);
        $list = $this->group->userGroup($limit, $user_id);
        return $this->success($list);
    }

    /**
     * 参与竞价
     *
     * @bodyParam goods_id int required 商品 ID
     * @bodyParam group_id int required 团购 ID
     * @bodyParam price int required 出价（分）
     * @return JsonResponse
     * @throws ApiException
     */
    public function store()
    {
        $params = $this->request->all();
        $validator = Validator::make($params, [
            'goods_id' => 'required|int|bail',
            'group_id' => 'required|int|bail',
            'price' => ['required', 'int', new GoodsPrice($params['goods_id'])],
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
        $params['user_id'] = $user_id; //TODO:
        $res = $this->group->store($params);
        return $this->success($res);
    }


    /**
     * 获取该商品当前团购价(分)
     *
     * @urlParam goods_id  required int 商品 ID
     * @response {
     * "code": 1,
     * "message": "",
     * "data": 36002
     * }
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

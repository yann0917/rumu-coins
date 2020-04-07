<?php

namespace App\Http\Controllers;

use App\Exceptions\Errors;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    public $jwt;
    public $request;
    public $user;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->getHeaders();
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }
    private function getHeaders()
    {
        $request = $this->request;
        $authorization = $request->header('authorization', 'Bearer ');
        $this->jwt = substr($authorization, 7);
        if ($this->jwt) {
            $this->user = auth('api')->user();
        }
    }



    /**
     * 成功响应
     *
     * @param $data
     * @return JsonResponse
     */
    public function success($data)
    {
        $res = Errors::defaultData();
        $res['data'] = $data;
        return response()->json($res, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 失败响应
     *
     * @param int    $code
     * @param string $msg
     * @return JsonResponse
     */
    public function error(int $code = Errors::ERR_UNKNOWN_ERROR, $msg = '')
    {
        $res = $msg
            ? ['code' => $code, 'message' => $msg]
            : Errors::returnData($code);

        return response()->json($res, 200, [], JSON_UNESCAPED_UNICODE);
    }

}

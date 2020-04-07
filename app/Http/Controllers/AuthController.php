<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Exceptions\Errors;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AuthController extends BaseController
{
    public $miniapp;
    public $user;

    public function __construct(Request $request, User $user)
    {
        parent::__construct($request);
        $this->user = $user;
    }

    /**
     *
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiException
     */
    public function login()
    {
        // 公众号授权登录
        $code = $this->request->get('code');
        if (!$code) {
            throw new ApiException(Errors::ERR_PARAM);
        }
        $this->miniapp = app('wechat.mini_program');
        $user = $this->miniappLogin($this->request);
        $miniapp_id = $user['miniapp_id'];
        $userInfo = $this->user::withTrashed()
            ->where('miniapp_id', $miniapp_id)
            ->first();
        if (empty($userInfo)) {
            $userInfo = $this->user->create($user);
        } else {
            // 删除的用户
            if ($userInfo->deleted_at) {
                throw new ApiException(Errors::ERR_USER_NO_EXIST);
            }
            // TODO: 保存小程序 session_key
            // $minipro_session_user_id = $userInfo->user_id;
            $data = Arr::except($user, ['language', 'privilege']);
            $this->user
                ->where('id', $userInfo['id'])
                ->update($data);
        }

        if (!$token = auth('api')->fromUser($userInfo)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }


    public function miniappLogin(Request $request)
    {
        if (!$request->code) {
            throw new ApiException(Errors::ERR_PARAM);
        }

        // if (PHP_SAPI == "cli") {
        //     $miniapp = $this->wechat['miniapp'];
        // } else {
        //     $miniapp = $this->miniapp;
        // }

        $userInfo = $this->miniapp->auth->session($request->code);

        if (!isset($userInfo['openid'])) {
            throw new ApiException($userInfo['errmsg']);
        }

        // 解密信息, 空格转加号
        $encryptedData = str_replace(" ", "+", $request->encryptedData);
        $iv = str_replace(" ", "+", $request->iv);

        $decryptedData = $this->miniapp->encryptor->decryptData($userInfo['session_key'], $iv, $encryptedData);
        switch (isset($decryptedData['gender'])) {
            case '1':
                $sex = 1;
                break;
            case '2':
                $sex = 0;
                break;
            default:
                $sex = 2;
                break;
        }

        $userInfo = [
            'name' => $decryptedData['nickName'] ?? '',
            'miniapp_id' => $decryptedData['openId'],
            'nickname' => $decryptedData['nickName'] ?? '',
            'sex' => $sex,
            'language' => $decryptedData['language'],
            'city' => $decryptedData['city'],
            'province' => $decryptedData['province'],
            'country' => $decryptedData['country'],
            'avatar' => $decryptedData['avatarUrl'],
            'privilege' => [],
            'unionid' => $decryptedData['unionId'] ?? '',
        ];

        return $userInfo;
    }
}

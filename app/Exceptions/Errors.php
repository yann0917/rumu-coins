<?php
/**
 * @Author: zhaoyabo
 * @Date  : 2020/4/6 17:01
 * @Last  Modified by: zhaoyabo
 * @Last  Modified time: 2020/4/6 17:01
 */

namespace App\Exceptions;


class Errors
{
    const ERR_NO_ERROR = 1;
    const ERR_UNKNOWN_ERROR = 0;
    const ERR_UNDEFINED = 999;
    const ERR_TOO_MANY_REQUEST = 429;

    const ERR_PARAM = 1000;
    const ERR_UNLOGIN = 1001;
    const ERR_INVALID_TOKEN = 1002;
    const ERR_INVALID_SESSION = 1003;
    const ERR_UNAUTHORIZED = 1004;
    const ERR_TCP_TIMEOUT = 1504;
    const ERR_HTTP_TIMEOUT = 1505;

    const ERR_MYSQL = 2000;
    const ERR_MYSQL_INSTALL_FAIL = 2001;
    const ERR_MYSQL_DELETE_FAIL = 2002;
    const ERR_MYSQL_UPDATE_FAIL = 2003;
    const ERR_MYSQL_POOL_FAIL = 2004;
    const ERR_REDIS_POOL_FAIL = 2104;
    const ERR_IDGEN_FAIL = 2404;
    const ERR_UPLOAD_FILE_ERROR = 2500;

    const  ERR_USER_NO_EXIST = 10001;

    public static $ERR_MSG_BASE = [
        self::ERR_NO_ERROR => '',
        self::ERR_UNKNOWN_ERROR => '未知错误',
        self::ERR_UNDEFINED => '未定义错误',
        self::ERR_TOO_MANY_REQUEST => '操作过于频繁, 请稍候再试',

        self::ERR_PARAM => '参数错误',
        self::ERR_UNLOGIN => '请先注册登录',
        self::ERR_INVALID_TOKEN => '无效的token',
        self::ERR_INVALID_SESSION => '无效的session信息',
        self::ERR_UNAUTHORIZED => '您没有权限访问该数据',
        self::ERR_TCP_TIMEOUT => 'TCP接口响应超时',
        self::ERR_HTTP_TIMEOUT => ' 请求超时请稍候重试~',  // http 请求 超时

        self::ERR_MYSQL => 'MySQL错误',
        self::ERR_MYSQL_INSTALL_FAIL => '数据插入失败',
        self::ERR_MYSQL_DELETE_FAIL => '数据删除失败',
        self::ERR_MYSQL_UPDATE_FAIL => '数据更新失败',
        self::ERR_MYSQL_POOL_FAIL => 'mysql连接池丢失',
        self::ERR_REDIS_POOL_FAIL => 'redis连接池丢失',
        self::ERR_IDGEN_FAIL => 'id生成失败',
        self::ERR_UPLOAD_FILE_ERROR => '文件上传错误',
    ];

    public static $ERR_MSG = [
        self::ERR_USER_NO_EXIST => '用户不存在',
    ];

    public static $DEFAULT_RETURN = [
        'code' => self::ERR_NO_ERROR,
        'message' => '',
        'data' => '{}',
    ];

    public static function defaultData()
    {
        return self::$DEFAULT_RETURN;
    }

    public static function getErrMsg($errNum)
    {
        $ERR_MSG = self::$ERR_MSG_BASE + self::$ERR_MSG;

        if (isset($ERR_MSG[$errNum])) {
            return $ERR_MSG[$errNum];
        } else {
            return $ERR_MSG[self::ERR_UNDEFINED];
        }
    }

    public static function returnData($errNum)
    {
        return [
            'code' => $errNum,
            'message' => self::getErrMsg($errNum),
            'data' => (object)[],
        ];
    }

}

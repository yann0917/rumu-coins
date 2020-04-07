<?php
/**
 * @Author: zhaoyabo
 * @Date  : 2020/4/6 16:58
 * @Last  Modified by: zhaoyabo
 * @Last  Modified time: 2020/4/6 16:58
 */

namespace App\Exceptions;
use Exception;
use Throwable;

class ApiException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = $message ?: Errors::getErrMsg($code);
        parent::__construct($message, $code, $previous);
    }
}

<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Box;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    protected $api = 'https://data.zhai78.com/openOneGood.php';
    protected $sweet = 'https://api.lovelive.tools/api/SweetNothings';
    protected $flatter = 'https://chp.shadiao.app/api.php';

    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row(Box::make('欢迎回来', $this->getSweet()));
                    $column->row(Box::make('每日彩虹屁', $this->getFlatter()));
                });
            });
    }

    protected function getCurl(string $url)
    {
        $http = new \GuzzleHttp\Client();
        $response = $http->get($url);
        $response = (string)$response->getBody();
        if ($this->isJson($response)) {
            return json_decode($response, true);
        }
        return $response;
    }

    protected  function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function getSweet():string
    {
        $key = 'daily:sweet';
        $count = Redis::sCard($key);
        if ($count > 365) {
            $sweet = Redis::sRandMember($key);
        } else {
            $sweet = $this->getCurl($this->sweet);
            Redis::sAdd($key, $sweet);
        }
        return $sweet;
    }

    public function getFlatter():string
    {
        $key = 'daily:flatter';
        $count = Redis::sCard($key);
        if ($count > 365) {
            $flatter = Redis::sRandMember($key);
        } else {
            $flatter = $this->getCurl($this->flatter);
            Redis::sAdd($key, $flatter);
        }
        return $flatter;
    }
}

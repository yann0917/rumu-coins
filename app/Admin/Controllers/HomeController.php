<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Box;

class HomeController extends Controller
{
    protected $api = 'https://data.zhai78.com/openOneGood.php';
    protected $sweet = 'https://api.lovelive.tools/api/SweetNothings';
    protected $flatter = 'https://chp.shadiao.app/api.php';
    protected $lunar = 'https://www.sojson.com/open/api/lunar/json.shtml';
    protected $soaps = [
        '过往不恋，未来不迎，当下不负，如此安好。',
        '成名每在穷苦日，败事多因得意时。',
        '一个人的态度，决定他的高度。',
        '生活在喜怒哀乐间走走停停，不知道会遇见什么，只知道阳光这么好，别辜负了今天。',
        '宁愿跑起来被拌倒无数次，也不愿规规矩矩走一辈子。就算跌倒也要豪迈的笑。',
        '努力和上进，不是为了做给别人看，是为了不辜负自己，不辜负此生。',
        '努力是一种生活态度，与年龄无关。',
    ];

    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row(Box::make('欢迎回来', $this->getCurl($this->sweet)));
                    $column->row(Box::make('每日彩虹屁', $this->getCurl($this->flatter)));
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
}

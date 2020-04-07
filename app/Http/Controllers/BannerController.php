<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Resources\Banner as BannerResource;

class BannerController extends BaseController
{
    public $banner;
    public function __construct(Request $request, Banner $banner)
    {
        parent::__construct($request);
        $this->banner = $banner;
    }

    public function index()
    {
        $list = $this->banner
            ->select('url', 'sort')
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->limit(10)
            ->get();
        return $this->success(BannerResource::collection($list));
    }
}

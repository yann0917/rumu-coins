<?php

namespace App\Http\Controllers;

use App\Models\GroupConfig;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * Display a listing of the resource.
     * 往期团购列表
     *
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $detail = $this->groupConfig->where('id', $id)->with('coins')->first();
        return $this->success($detail);
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

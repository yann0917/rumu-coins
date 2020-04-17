<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\GroupExport as GroupExportTools;
use App\Admin\Repositories\Group;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GroupExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class GroupController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $group_id = request()->get('group_id');
        return Grid::make(new Group(), function (Grid $grid) use ($group_id) {
            $grid->disableCreateButton();

            $grid->disableActions();
            // $grid->actions(function (Grid\Displayers\Actions $actions) {
            //     // 当前行的数据数组
            //     $rowArray = $actions->row->toArray();
            //     // dump($rowArray);
            // });

            $grid->id->sortable();
            $grid->tools(function (Grid\Tools $tools) {
                $tools->append(new GroupExportTools());
            });
            $grid->model()->with(['user', 'goods'])->where('group_id', '=', $group_id);
            $grid->id->sortable();
            $grid->column('sn', '号码')->display(function () {
                return $this->goods['sn'];
            });
            $grid->column('category', '分类')->display(function () {
                return $this->goods['category'];
            });
            $grid->column('score', '分数')->display(function () {
                return $this->goods['score'];
            });
            $grid->column('sn_no', '证书号')->display(function () {
                return $this->goods['sn_no'];
            });
            $grid->column('low_price', '起步价')->display(function () {
                return $this->goods['low_price'] * 0.01;
            })->help('人民币元');
            $grid->column('top_price', '封顶价')->display(function () {
                return $this->goods['top_price'] * 0.01;
            })->help('人民币元');

            $grid->column('nickname', '出价人昵称')->display(function () {
                return $this->user['nickname'];
            });
            $grid->column('avatar', '出价人头像')->display(function () {
                return $this->user['avatar'] ;
            })->image(url(), 32, 32);
            $grid->column('price', '出价金额')->display(function () {
                $price = $this->price * 0.01;
                return  $this->goods['top_price'] * 0.01 == $price
                    ? "<p class='badge badge-success'>{$price}</p>"
                    : $price ;
            })->help('人民币元');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Group(), function (Show $show) {
            $show->id;
            $show->goods_id;
            $show->price;
            $show->user_id;
            // $show->created_at;
            // $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Group(), function (Form $form) {
            $form->display('id');
            $form->text('goods_id');
            $form->text('price');
            $form->text('user_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    /**
     * 导出参团用户
     *
     * @param int $group_id
     * @return BinaryFileResponse
     */
    public function userExport(int $group_id)
    {
        $fileName = $group_id .'期团购_'.date('Y-m-d-H-i-s').'.xlsx';
        return Excel::download(new GroupExport($group_id), $fileName);
    }
}

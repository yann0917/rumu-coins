<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\GroupConfig;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class GroupConfigController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new GroupConfig(), function (Grid $grid) {
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if ( time() >= strtotime($this->start_at) && time() < strtotime($this->end_at)) {
                    // 进行中
                    $actions->disableDelete();
                    $actions->disableEdit();
                } elseif (time() >= strtotime($this->end_at) && time() >= strtotime($this->start_at)) {
                    // 已结束
                    $actions->disableDelete();
                    $actions->disableEdit();
                } else {
                    $actions->disableDelete(false);
                    $actions->disableEdit(false);
                }
            });

            $grid->id->sortable();
            $grid->issue->sortable();
            $grid->start_at;
            $grid->end_at;

            // TODO: 展示商品数量
            $grid->column('goods_nums')->display(function () {
                return 100;
            });

            $grid->column('status')->display(function () {
                $status = 0;
                if ( time() >= strtotime($this->start_at) && time() < strtotime($this->end_at)) {
                    $status = 1;
                } elseif (time() >= strtotime($this->end_at) && time() >= strtotime($this->start_at)) {
                    $status = 2;
                } else {
                    $status = 0;
                }
                return $status;
            })
            ->using([
                0 => '未开始',
                1 => '进行中',
                2 => '已结束',
            ]);
            // $grid->created_at;
            // $grid->updated_at->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal('id');
                $filter->equal('issue');

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
        return Show::make($id, new GroupConfig(), function (Show $show) {
            $show->disableQuickEdit();
            $show->disableEditButton();
            $show->disableDeleteButton();
            $show->id;
            $show->issue;
            $show->start_at;
            $show->end_at;
            $show->created_at;
            $show->updated_at;

            $show->divider();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new GroupConfig(), function (Form $form) {
            $form->display('id');
            $form->number('issue')->required()->attribute('min', 1);
            $form->datetime('start_at')
                ->format('YYYY-MM-DD HH:mm:ss')
                ->rules('required|date|after:10minute ', [
                    'after' => ':attribute必须大于 10 分钟之后',
                ]);
            $form->datetime('end_at')
                ->format('YYYY-MM-DD HH:mm:ss')
                ->rules('required|date|after:start_at', [
                    'after' => ':attribute必须大于开始时间',
                ]);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}

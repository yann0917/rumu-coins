<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\CoinImport;
use App\Admin\Repositories\GroupConfig;
use App\Models\GroupCoin;
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
            $grid->model()->with('goods');
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

            // 展示商品数量
            $grid->column('goods_nums')->display(function () {
                return count($this->goods);
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
            // 展示商品数量
            $grid->column('团购明细')->display(function () {
                return "<a href=".admin_url('group') . '?group_id=' . $this->id .">查看明细" ."</a>";
            });
            $grid->filter(function (Grid\Filter $filter) {
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

            // $show->id->width(3);
            $show->issue->as(function ($issue) {
                return $issue . '期';
            })->width(3);

            $show->column('状态')->as(function() {
                if ( time() >= strtotime($this->start_at) && time() < strtotime($this->end_at)) {
                    $status = 1;
                } elseif (time() >= strtotime($this->end_at) && time() >= strtotime($this->start_at)) {
                    $status = 2;
                } else {
                    $status = 0;
                }
                return $status;
            })->using([
                0 => '未开始',
                1 => '进行中',
                2 => '已结束',
            ])->label()->width(3);
            $show->start_at->width(3);
            $show->end_at->width(3);
            // $show->created_at;
            // $show->updated_at;

            $show->divider();
            // 一对多关联
            $show->coins(function ($model) {
                return Grid::make(new GroupCoin(), function (Grid $grid) use($model) {
                    if ( time() >= strtotime($model->start_at) && time() < strtotime($model->end_at)) {
                        $status = 1;
                    } elseif (time() >= strtotime($model->end_at) && time() >= strtotime($model->start_at)) {
                        $status = 2;
                    } else {
                        $status = 0;
                    }
                    if ($status == 0) {
                        // 未开始可以导入数据
                        $grid->tools(function (Grid\Tools $tools) {
                            $tools->append(new CoinImport());
                        });
                    }
                    // 禁用创建按钮
                    $grid->disableCreateButton();
                    $grid->disableActions(); // 禁用操作

                    $grid->model()->where('group_id', $model->id);
                    $grid->resource('/group/coins');

                    $grid->id->sortable();
                    // $grid->group_id;
                    $grid->sn('号码')->sortable();
                    $grid->category('分类');
                    $grid->score('分数')->sortable();
                    $grid->sn_no('证书号');
                    $grid->low_price('起步价')->display(function ($low_price) {
                        return $low_price * 0.01;
                    })->help('人民币元');
                    $grid->top_price('封顶价')->display(function ($top_price) {
                        return $top_price * 0.01;
                    })->help('人民币元');

                    $grid->created_at;
                    // $grid->updated_at->sortable();
                    // $grid->filter(function (Grid\Filter $filter) {
                    //     $filter->equal('id');
                    // });
                });
            });
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
            $form->number('issue')->required()->attribute('min', 1)->width(4);
            $form->datetime('start_at')
                ->format('YYYY-MM-DD HH:mm:ss')
                ->rules('required|date|after:10minute ', [
                    'after' => ':attribute必须大于 10 分钟之后',
                ])->width(4);
            $form->datetime('end_at')
                ->format('YYYY-MM-DD HH:mm:ss')
                ->rules('required|date|after:start_at', [
                    'after' => ':attribute必须大于开始时间',
                ])->width(4);

            // $form->display('created_at');
            // $form->display('updated_at');
        });
    }
}

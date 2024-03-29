<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Wechat;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class WechatController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Wechat(), function (Grid $grid) {
            $grid->disableViewButton();
            $grid->disableDeleteButton();
            $grid->id->sortable();
            $grid->wechat_account;
            $grid->qrcode()->image();
            // $grid->created_at;
            // $grid->updated_at->sortable();
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
        return Show::make($id, new Wechat(), function (Show $show) {
            $show->id;
            $show->wechat_account;
            $show->qrcode()->image();
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
        return Form::make(new Wechat(), function (Form $form) {
            $form->display('id');
            $form->text('wechat_account');
            $form->image('qrcode')->uniqueName();
            // $form->display('created_at');
            // $form->display('updated_at');
        });
    }
}

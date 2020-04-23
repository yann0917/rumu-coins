<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->disableCreateButton();
            $grid->disableActions();

            $grid->id->sortable();
            $grid->nickname;
            $grid->avatar->image(url(), 48, 48);
            // $grid->status->using([ 0 => '已拉黑', 1 => '正常用户'])->label(
            //     [
            //         0 => 'danger',
            //         1 => 'success'
            //     ]
            // );
            $grid->status->switch()->help('开关关闭表示已拉黑');
            $grid->advance_status->switch();
            $grid->sex->using([ 0 => '女', 1 => '男']);
            $grid->country;
            $grid->province;
            $grid->city;
            // $grid->created_at;
            // $grid->updated_at->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('nickname');
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
        return Show::make($id, new User(), function (Show $show) {
            $show->id;
            // $show->email;
            // $show->email_verified_at;
            // $show->name;
            // $show->password;
            // $show->remember_token;
            $show->avatar->image();
            $show->nickname;
            $show->unionid;
            $show->miniap_id;
            $show->status;
            $show->advance_status;
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
        return Form::make(new User(), function (Form $form) {

            // 去除整个工具栏内容
            // $form->disableHeader();

            // 也可以通过以下方式去除工具栏的默认按钮
            // $form->disableListButton();
            $form->disableViewButton();
            $form->disableDeleteButton();

            $form->display('id');
            // $form->text('email');
            // $form->text('email_verified_at');
            // $form->text('name');
            // $form->text('password');
            // $form->text('remember_token');
            // $form->image('avatar');
            $form->display('nickname');
            $form->switch('status', '正常用户');
            $form->switch('advance_status', '提前竞价');
            // $form->display('created_at');
            // $form->display('updated_at');
        });
    }
}

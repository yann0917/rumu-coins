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
            $grid->id->sortable();
            $grid->email;
            $grid->email_verified_at;
            $grid->name;
            $grid->password;
            $grid->remember_token;
            $grid->avatar;
            $grid->created_at;
            $grid->updated_at->sortable();
        
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
        return Show::make($id, new User(), function (Show $show) {
            $show->id;
            $show->email;
            $show->email_verified_at;
            $show->name;
            $show->password;
            $show->remember_token;
            $show->avatar;
            $show->created_at;
            $show->updated_at;
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
            $form->display('id');
            $form->text('email');
            $form->text('email_verified_at');
            $form->text('name');
            $form->text('password');
            $form->text('remember_token');
            $form->text('avatar');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}

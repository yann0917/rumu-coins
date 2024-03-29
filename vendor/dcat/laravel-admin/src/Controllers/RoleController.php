<?php

namespace Dcat\Admin\Controllers;

use Dcat\Admin\Auth\Permission;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\IFrameGrid;
use Dcat\Admin\Models\Repositories\Role;
use Dcat\Admin\Models\Role as RoleModel;
use Dcat\Admin\Show;
use Dcat\Admin\Support\Helper;
use Dcat\Admin\Widgets\Tree;

class RoleController extends AdminController
{
    /**
     * Get content title.
     *
     * @return string
     */
    public function title()
    {
        return trans('admin.roles');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        if ($mini = request(IFrameGrid::QUERY_NAME)) {
            $grid = new IFrameGrid(new Role());
        } else {
            $grid = new Grid(new Role());
        }

        $grid->id('ID')->sortable();
        $grid->slug->label('primary');
        $grid->name;

        if (! $mini) {
            $grid->created_at;
            $grid->updated_at->sortable();
        }

        $grid->disableBatchDelete();
        $grid->disableEditButton();
        $grid->showQuickEditButton();
        $grid->disableFilterButton();
        $grid->quickSearch(['id', 'name', 'slug']);
        $grid->enableDialogCreate();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $roleModel = config('admin.database.roles_model');
            if ($roleModel::isAdministrator($actions->row->slug)) {
                $actions->disableDelete();
            }
        });

        return $grid;
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
        return Show::make($id, new Role('permissions'), function (Show $show) {
            $show->id;
            $show->slug;
            $show->name;

            $show->permissions->unescape()->as(function ($permission) {
                $permissionModel = config('admin.database.permissions_model');
                $permissionModel = new $permissionModel();
                $nodes = $permissionModel->allNodes();

                $tree = Tree::make($nodes);

                $keyName = $permissionModel->getKeyName();
                $tree->check(
                    array_column(Helper::array($permission), $keyName)
                );

                return $tree->render();
            });

            $show->created_at;
            $show->updated_at;

            if ($show->getKey() == RoleModel::ADMINISTRATOR_ID) {
                $show->disableDeleteButton();
            }
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(new Role('permissions'), function (Form $form) {
            $roleTable = config('admin.database.roles_table');
            $connection = config('admin.database.connection');

            $id = $form->getKey();

            $form->display('id', 'ID');

            $form->text('slug', trans('admin.slug'))
                ->required()
                ->creationRules(['required', "unique:{$connection}.{$roleTable}"])
                ->updateRules(['required', "unique:{$connection}.{$roleTable},slug,$id"]);

            $form->text('name', trans('admin.name'))->required();

            $form->tree('permissions')
                ->nodes(function () {
                    $permissionModel = config('admin.database.permissions_model');
                    $permissionModel = new $permissionModel();

                    return $permissionModel->allNodes();
                })
                ->customFormat(function ($v) {
                    if (! $v) {
                        return [];
                    }

                    return array_column($v, 'id');
                });

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));

            if ($id == RoleModel::ADMINISTRATOR_ID) {
                $form->disableDeleteButton();
            }
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (in_array(RoleModel::ADMINISTRATOR_ID, Helper::array($id))) {
            Permission::error();
        }

        return parent::destroy($id);
    }
}

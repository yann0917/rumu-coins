<?php

namespace App\Admin\Controllers;

use App\Models\GroupCoin;
use App\Imports\CoinsImport;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Maatwebsite\Excel\Facades\Excel;

class GroupCoinController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new GroupCoin(), function (Grid $grid) {
            // $grid->export();
            $grid->disableActions(); // 禁用操作
            $grid->disableCreateButton();

            $grid->id->sortable();
            $grid->group_id;
            $grid->sequence;
            $grid->sn->sortable();
            $grid->category;
            $grid->score->sortable();
            $grid->sn_no;
            $grid->low_price->display(function ($low_price) {
                return $low_price * 0.01;
            });
            $grid->top_price->display(function ($top_price) {
                return $top_price * 0.01;
            });
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
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new GroupCoin(), function (Show $show) {
            $show->id;
            $show->group_id;
            $show->sequence;
            $show->sn;
            $show->category;
            $show->score;
            $show->sn_no;
            $show->low_price;
            $show->top_price;
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
        return Form::make(new GroupCoin(), function (Form $form) {
            $form->display('id');
            $form->text('group_id');
            $form->text('sequence');
            $form->text('sn');
            $form->text('category');
            $form->text('score');
            $form->text('sn_no');
            $form->number('low_price');
            $form->number('top_price');

            // $form->display('created_at');
            // $form->display('updated_at');
        });
    }

    /**
     * 导入数据
     *
     * @param int $group_id
     * @return RedirectResponse|Redirector
     */
    public function coinsImport(int $group_id)
    {
        $hasXlsx = request()->hasFile('file');
        if (!$hasXlsx) {
            return redirect('admin/group/configs/' . $group_id);
        }
        $data = Excel::toArray(new CoinsImport, request()->file('file'));
        foreach ($data[0] as &$item) {
            $item[] = $group_id;
        }
        // 删除旧数据，重新导入
        if ($group_id != 0) {
            GroupCoin::where('group_id', $group_id)->delete();
        }
        $rows = $data[0];
        unset($rows[0]);
        foreach ($rows as $row) {
            GroupCoin::create([
                'sequence'=> $row[0],
                'sn' => $row[1],
                'category' => $row[2],
                'score' => $row[3],
                'sn_no' => $row[4],
                'low_price' => $row[5] * 100,
                'top_price' => $row[6] * 100,
                'group_id' => $row[7],
            ]);
        }
        // Excel::import(new CoinsImport, request()->file('file'));
        return redirect('admin/group/configs/' . $group_id);
    }
}

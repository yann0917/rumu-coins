<?php
/**
 * @Author: zhaoyabo
 * @Date  : 2020/4/5 20:22
 * @Last  Modified by: zhaoyabo
 * @Last  Modified time: 2020/4/5 20:22
 */

namespace App\Admin\Extensions\Tools;

use Dcat\Admin\Admin;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class GroupExport extends AbstractTool
{
    protected function script()
    {
        $url = Request::all('group_id');
        // ['group_id'=>1]
        $url = admin_base_path('group/export') .'/' . $url['group_id'];
        return <<<JS
$("#group-export").attr("action", "$url")
JS;
    }

    public function render()
    {
        Admin::script($this->script());
        return view('admin.tools.group-export');
    }
}

<?php
/**
 * @Author: zhaoyabo
 * @Date  : 2020/4/6 19:58
 * @Last  Modified by: zhaoyabo
 * @Last  Modified time: 2020/4/6 19:58
 */

namespace App\Models;


use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;
    use HasDateTimeFormatter;

    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'extra'];
}

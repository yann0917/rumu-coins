<style>
    .file {
        position: relative;
        display: inline-grid;
        background: #D0EEFF;
        border: 1px solid #99D3F5;
        border-radius: 4px;
        padding: 8px 18px;
        overflow: hidden;
        color: #1E88C7;
        text-decoration: none;
        text-indent: 0;
        line-height: 20px;
    }
    .file input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
    }
    .file:hover {
        background: #AADFFD;
        border-color: #78C3F3;
        color: #004974;
        text-decoration: none;
    }
</style>
<div class="btn-group">
    <form id="coins-import" class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{--        <label for="file" class="col-md-4 control-label">Hello world</label>--}}

        <div class="row">
            <div class="col-md-6">
                <a href="javascript:;" class="file">选择文件
                    <input type="file" name="file" id="coins-file">
                </a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i> 导入数据
                </button>
            </div>
        </div>
    </form>
</div>

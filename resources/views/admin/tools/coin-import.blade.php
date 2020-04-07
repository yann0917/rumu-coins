<style>
    .file {
        position: relative;
        display: inline-grid;
        background: #5c6bc6;
        border: none;
        border-radius: 4px;
        padding: 4px 10px;
        overflow: hidden;
        color: #FFFFFF;
        text-decoration: none;
        text-indent: 0;
        line-height: 18px;
    }

    .file input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
    }

    .file:hover {
        border: none;
        color: #FFFFFF;
        text-decoration: none;
        -webkit-box-shadow: #ccc 0px 2px 4px;
        -moz-box-shadow: #ccc 0px 2px 4px;
        box-shadow: #ccc 0px 2px 4px;
    }
</style>
<div class="btn-group">
    <form id="coins-import" class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <a href="javascript:void(0);" class="file">选择文件
                    <input type="file" name="file" id="coins-file">
                </a>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i>导 入
                </button>
            </div>
        </div>
    </form>
</div>

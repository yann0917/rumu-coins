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
    }

    .file input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
    }
</style>

<div class="btn-group filter-button-group btn-no-shadow">
  <form id="coins-import" class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#goodsImport">
        导入数据
    </button>
  <!-- Modal -->
    <div class="modal fade" id="goodsImport" tabindex="-1" role="dialog" aria-labelledby="title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalLongTitle">导入数据</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

                <div class="modal-body">
                    <div class="form-group">
                        <a href="javascript:void(0);" class="file btn-outline-primary grid-refresh btn-mini">选择文件
                            <input type="file" name="file" id="coins-file">
                        </a>
                    </div>
                </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="submit" class="btn btn-primary">上传</button>
            </div>
        </div>
        </div>
    </div>
</form>
</div>

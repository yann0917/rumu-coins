<?php

namespace Dcat\Admin\Traits;

use Dcat\Admin\Admin;
use Dcat\Admin\Form\Field\File;
use Dcat\Admin\Support\WebUploader;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

/**
 * 文件上传辅助功能.
 *
 * Trait HasUploadedFile
 */
trait HasUploadedFile
{
    /**
     * 获取文件上传管理.
     *
     * @return WebUploader
     */
    public function uploader()
    {
        return Admin::context()->webUploader;
    }

    /**
     * 获取上传文件.
     *
     * @return \Symfony\Component\HttpFoundation\File\UploadedFile|void
     */
    public function file()
    {
        return $this->uploader()->getCompleteUploadedFile();
    }

    /**
     * 获取文件管理仓库.
     *
     * @param string|null $disk
     *
     * @return \Illuminate\Contracts\Filesystem\Filesystem|FilesystemAdapter
     */
    public function disk(string $disk = null)
    {
        return Storage::disk($disk ?: config('admin.upload.disk'));
    }

    /**
     * 判断是否是删除请求.
     *
     * @return bool
     */
    public function isDeleteRequest()
    {
        return request()->has(File::FILE_DELETE_FLAG);
    }

    /**
     * 删除文件.
     *
     * @param \Illuminate\Contracts\Filesystem\Filesystem|FilesystemAdapter $disk
     * @param string|null                                                   $path
     *
     * @return bool
     */
    public function deleteFile($disk = null, $path = null)
    {
        $disk = $disk ?: $this->disk();

        return $disk->delete($path ?: request()->key);
    }

    /**
     * 删除文件并响应返回值.
     *
     * @param \Illuminate\Contracts\Filesystem\Filesystem|FilesystemAdapter $disk
     * @param string|null
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFileAndResponse($disk = null, $path = null)
    {
        $this->deleteFile($disk, $path);

        return $this->responseDeleted();
    }

    /**
     * 响应上传成功信息.
     *
     * @param string $path 文件完整路径
     * @param string $url
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseUploaded(string $path, string $url)
    {
        return response()->json([
            'status' => true,
            'id'     => $path,
            'name'   => basename($path),
            'path'   => basename($path),
            'url'    => $url,
        ]);
    }

    /**
     * 响应验证失败信息.
     *
     * @param mixed $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseValidationMessage($message)
    {
        return $this->responseErrorMessage($message, 103);
    }

    /**
     * 响应失败信息.
     *
     * @param $error
     * @param $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseErrorMessage($error, $code = 107)
    {
        return response()->json([
            'error' => ['code' => $code, 'message' => $error], 'status' => false,
        ]);
    }

    /**
     * 文件删除成功.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseDeleted()
    {
        return response()->json(['status' => true]);
    }

    /**
     * 文件删除失败.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseDeleteFail($message = '')
    {
        return response()->json(['status' => false, 'message' => $message]);
    }
}

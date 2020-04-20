<?php

namespace Dcat\Admin\Middleware;

use Dcat\Admin\Admin;
use Dcat\Admin\Support\Helper;
use Illuminate\Http\Request;

class Bootstrap
{
    public function handle(Request $request, \Closure $next)
    {
        $this->includeBootstrapFile();
        $this->setupScript();
        $this->fireEvents();

        $response = $next($request);

        $this->storeCurrentUrl($request);

        return $response;
    }

    protected function includeBootstrapFile()
    {
        if (is_file($bootstrap = admin_path('bootstrap.php'))) {
            require $bootstrap;
        }
    }

    protected function setupScript()
    {
        $token = csrf_token();
        Admin::script("Dcat.token = \"$token\";");
    }

    protected function fireEvents()
    {
        Admin::callBooting();

        Admin::callBooted();
    }

    /**
     * @param  \Illuminate\Http\Request
     *
     * @return void
     */
    protected function storeCurrentUrl(Request $request)
    {
        if (
            $request->method() === 'GET'
            && $request->route()
            && ! Helper::isAjaxRequest()
            && ! $this->prefetch($request)
        ) {
            Helper::setPreviousUrl($request->fullUrl());
        }
    }

    /**
     * @param  \Illuminate\Http\Request $request
     *
     * @return bool
     */
    public function prefetch($request)
    {
        if (method_exists($request, 'prefetch')) {
            return $request->prefetch();
        }

        return strcasecmp($request->server->get('HTTP_X_MOZ'), 'prefetch') === 0 ||
            strcasecmp($request->headers->get('Purpose'), 'prefetch') === 0;
    }
}

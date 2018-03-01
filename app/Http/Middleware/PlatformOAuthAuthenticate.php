<?php

namespace App\Http\Middleware;

use Closure;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Overtrue\LaravelWechat\Events\WeChatUserAuthorized;

/**
 * Class OAuthAuthenticate.
 */
class PlatformOAuthAuthenticate
{
    /**
     * Use Service Container would be much artisan.
     */
    private $wechat;

    /**
     * Inject the wechat service.
     */
    public function __construct(Application $wechat)
    {
       $companyId =  request()->get('company_id');
        $appId = 'wxfb55ae0afdc9a269';
        $refreshToken = '7_O5HLxbhGu6vr_UaXsiZwjuJwqvAdh8TrDxUzOOqj_lCXU85X9ChlBNpfX2PHB7aCcCQNKYsp24UF1rhkiY0pgeuvScvl2hl0iUvUzorWr4MiL74lD_g2rOg42vrVA2DZXkMLyGGQ7HGWuOE7HZIhAFDMEN';
        $this->wechat = $wechat->open_platform->createAuthorizerApplication($appId, $refreshToken);
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $scopes
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $scopes = 'snsapi_login')
    {
        $isNewSession = false;
        $onlyRedirectInWeChatBrowser = config('wechat.oauth.only_wechat_browser', false);

        if ($onlyRedirectInWeChatBrowser && !$this->isWeChatBrowser($request)) {
            if (config('debug')) {
                Log::debug('[not wechat browser] skip wechat oauth redirect.');
            }
            return $next($request);
        }


        if (is_string($scopes)) {
            $scopes = array_map('trim', explode(',', $scopes));
        }

        if (!session('wechat.platform.oauth_user')) {
            if ($request->has('code')) {
                session(['wechat.platform.oauth_user' => $this->wechat->oauth->user()]);
                $isNewSession = true;

                Event::fire(new WeChatUserAuthorized(session('wechat.platform.oauth_user'), $isNewSession));

                return redirect()->to($this->getTargetUrl($request));
            }

            session()->forget('wechat.platform.oauth_user');
//            dd($scopes);
            return $this->wechat->oauth->redirect($request->fullUrl());
        }

        Event::fire(new WeChatUserAuthorized(session('wechat.platform.oauth_user'), $isNewSession));

        return $next($request);
    }

    /**
     * Build the target business url.
     *
     * @param Request $request
     *
     * @return string
     */
    protected function getTargetUrl($request)
    {
        $queries = array_except($request->query(), ['code', 'state']);

        return $request->url().(empty($queries) ? '' : '?'.http_build_query($queries));
    }



    /**
     * Detect current user agent type.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function isWeChatBrowser($request)
    {
        return strpos($request->header('user_agent'), 'MicroMessenger') !== false;
    }
}

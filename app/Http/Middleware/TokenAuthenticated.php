<?php
/**
 * Created by PhpStorm.
 * User: hhb
 * Date: 2018/10/15
 * Time: 16:14
 */

namespace App\Http\Middleware;

use App\Http\Services\RedisService;
use Closure;


class TokenAuthenticated
{
    public function handle(
        $request,
        Closure $next,
        $guard = null
    )
    {
        //如果是OPTIONS请求则放行
        if ($request->method() == 'OPTIONS') return $next($request);
        $api_token = $request->header('api-token');
        if (!$api_token) {
            return returnJson('token不存在', '401');
        }
        $redisService = new RedisService();
        if (!$redisService->userTokenVerificationAndRefreshTime($api_token)) {
            return returnJson('token已过期,请重新登录', '401');
        }
        return $next($request);
    }
}
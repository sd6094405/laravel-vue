<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\BaseController;
use App\Http\Services\AdminService;
use App\Http\Services\CommandService;
use App\Http\Services\RedisService;
use App\Models\Permissions;
use Illuminate\Http\Request;

class LoginController extends BaseController
{

    /**
     * 管理员登录
     * @param AdminService $adminService
     * @param RedisService $redisService
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function LoginAdmin(
        AdminService $adminService,
        RedisService $redisService
    )
    {
        $input = $this->validatorRequest(
            [
                'email' => 'required|email',
                'password' => 'required|string'
            ]
        );
        //获取用户数据
        $userInfo = $adminService->login($input);
        if (!$userInfo) return returnJson('没有此账号', '403');
        //比对密码
        try{
            if (decryptString($input['password']) != decryptString($userInfo['password'])) return returnJson('密码错误', '403');
        }catch (\Exception $exception){
            return returnJson($exception->getMessage(),'500');
        }
        $userInfo['token'] = '';

        //令牌随机字符串
        $randString = make_str_rand(32);
        //生成Token
        $token = $redisService->makeUserToken($randString,$userInfo['id']);
        //记录本地登录Token
        $redisService->makeUserTokenRecord($userInfo['id'],$randString);
        //返回去除密码
        unset($userInfo['password']);
        //redis记录用户缓存数据
        $redisService->setKey(RedisService::USER_INFO.$randString,serialize($userInfo));
        $userInfo['token'] = $randString;
        return returnJson($userInfo);
    }

}

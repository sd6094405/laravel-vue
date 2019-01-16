<?php
/**
 * Created by PhpStorm.
 * User: hhb
 * Date: 2018/11/23
 * Time: 17:17
 */

namespace App\Http\Services;


use App\Models\Admins;
use App\Models\Permissions;
use App\Models\Users;

class AdminService
{
    protected $usersModel;

    public function __construct(
        Users $usersModel
    )
    {
        $this->usersModel = $usersModel;
    }

    public function login($data)
    {
        $userInfo = $this->usersModel->findByConditionOne([['email', $data['email']]]);
        if(empty($userInfo)) return false;
        return $userInfo->toArray();
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validateMessage()
    {
        return [
            'required' => '缺少 :attribute 字段',
            'unique' => '当前 :attribute 数据已存在',
            'max' => ' :attribute 超长',
            'min' => ' :attribute 长度不够',
            'numeric' => ' :attribute 必须是数字',
            'date' => ' :attribute 必须是 年月日时分秒'
        ];
    }

    /**
     * @param array $data
     * @param array $rules
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validatorRequest(Array $data, Array $rules)
    {
        return Validator::make($data, $rules, $this->validateMessage());
    }
}

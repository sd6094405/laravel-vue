<?php

namespace App\Http\Controllers\Home\Api;

use App\Http\Controllers\BaseController;
use App\Http\Services\CosClientService;
use App\Models\Systems;
use Illuminate\Http\Request;

class TenCentCosController extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function setting()
    {
        $data = (new Systems)->findByConditionOne([],'',[['id','desc']]);
        return returnJson($data);
    }

    public function Sign(CosClientService $clientService)
    {
        return returnJson($clientService->sign());
    }
}

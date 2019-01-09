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
        $data = (new Systems)->findByConditionOne([], '', [['id', 'desc']]);
        return returnJson($data);
    }

    public function Sign(
        CosClientService $clientService,
        Request $request
    )
    {
        return returnJson($clientService->sign($request->input('name')));
    }

    public function test(Request $request)
    {

    }
}

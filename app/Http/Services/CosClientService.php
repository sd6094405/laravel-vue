<?php
/**
 * Created by PhpStorm.
 * User: HHB
 * Date: 2019/1/8
 * Time: 12:43
 */

namespace App\Http\Services;


use Qcloud\Cos\Client;

class CosClientService
{
    private $client;
    private $secretId;
    private $servretKey;

    public function __construct()
    {
        $this->client = new Client([
            'region' => config('cos.cos_region'),
            'credentials' => [
//                'app_id' => config('cos.cos_appId'),
                'secretId' => config('cos.cos_secretId'),
                'secretKey' => config('cos.cos_secretKey'),
            ]
        ]);
    }

    public function sign()
    {
        $command = $this->client->getCommand('putObject', [
            'Bucket' => config('cos.cos_bucket'),
            'Key' => config('cos.cos_secretKey'),
            'Body' => ''
        ]);
        $signedUrl = $command->createPresignedUrl('+10 minutes');
        return $signedUrl;
//        return dd($this->client->listObjects(['Bucket'=>config('cos.cos_bucket')]));
    }
}
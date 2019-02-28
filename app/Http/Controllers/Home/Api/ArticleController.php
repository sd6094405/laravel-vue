<?php

namespace App\Http\Controllers\Home\Api;

use App\Http\Controllers\BaseController;
use App\Models\AccessLogs;
use App\Models\Articles;
use GeoIp2\Database\Reader;
use Illuminate\Http\Request;


class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = (new Articles)->findByConditionPage(
            [['is_home',1]],
            null,
            [['created_at','desc']],
            $request->page,
            $request->pageSize,
            null,
            null
        );
        return returnJson($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \GeoIp2\Exception\AddressNotFoundException
     * @throws \MaxMind\Db\Reader\InvalidDatabaseException
     */
    public function show($id,Request $request)
    {

        $data = (new Articles)->findByConditionOne(['id'=>$id])->toArray();
        $readNum = $data['read']+1;
        $data['read'] = $readNum;
        $reader = new Reader(config('app.geo_path'));
        try{
            $ip = $request->getClientIp();
            $add = $reader->city($ip);
            $country = $add->country->names['zh-CN'];
            $city = $add->city->names['zh-CN'];
            (new AccessLogs)->addData([
                'article_id'    =>  $id,
                'ip'    =>  $ip,
                'country'   =>  $country,
                'city'  =>  $city
            ]);
        }catch (\Exception $exception){

        }
        (new Articles)->query()->where(['id'=>$id])->update(['read'=>$readNum]);
//         $parsedown = new \Parsedown();
//         $data['body'] = $parsedown->setMarkupEscaped(true)->text($data['body']);
        return returnJson($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function category($id)
    {
        if(empty($id) || !is_numeric($id)){
            return false;
        }
        $where = [];
        $keyword = [['tag_id','like','%'.$id.'%']];
        $pageData = (new Articles)->findByConditionPage(
            $where,
            '',
            [['created_at', 'desc']],
            $input['page'] ?? 1,
            $input['pageSize'] ?? 10,
            $keyword,
            ''
        );
        return returnJson($pageData);
    }
}

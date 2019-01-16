<?php
/**
 * Created by PhpStorm.
 * User: hhb
 * Date: 2018/11/21
 * Time: 17:23
 */

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Container\Container;


class RedisService
{
    const USER_TOKEN = 'USER_TOKEN:';     //管理后端登录token
    const TOKEN_KEY = 'TOKEN_KEY:';      //存储管理后端上次登录的key，唯一登录用
    const USER_INFO = 'USER_INFO:';     //管理后端用户信息
    const LOGIN_CODE = 'LOGIN_CODE:';             //手机验证码登陆
    const APP_LOGIN = 'APP_LOGIN:';   //APP登陆状态，token
    const APP_TOKEN_KEY = 'APP_TOKEN_KEY:'; //app上次请求的token
    const USER_TABLE = 'USER_TABLE'; //用户分数、抽奖次数等哈希key
    const GOODS_BROWSE = 'GOODS_BROWSE:'; //浏览记录
    const GOODS_COLLECT = 'GOODS_COLLECT:'; //收藏记录
    const RATE_URL = 'RATE_URL:'; //高佣转链
    const HOT_KEYS = 'HOT_KEYS'; //高佣转链

    public $redis;

    public function __construct()
    {
        if (!$this->redis) {
            $this->redis = Container::getInstance()->make('redis');
        }

        return $this->redis;
    }

    /**
     * 根据键名获取redis数据
     * @param String $key
     * @param null $rule
     * @return mixed
     */
    public function getKey(String $key)
    {
        return $this->redis->get($key);
    }

    /**
     * 设置Key
     * @param String $key
     * @param String $value
     * @param bool $expire
     * @return mixed
     */
    public function setKey(String $key, String $value, $expire = false)
    {
        if ($expire) {
            $r = $this->redis->setex($key, $expire, $value);
        } else {
            $r = $this->redis->set($key, $value);
        }
        return $r;
    }

    /**
     * 用户登录设置Token
     * @param $rand_string
     * @param $user_id
     * @return mixed
     */
    public function makeUserToken($rand_string, $user_id)
    {
        return $this->redis->setex(self::USER_TOKEN . $rand_string, config('project.token_expiration_time'), $user_id);
    }

    /**
     * 唯一登录，记录上次登录Token
     * @param int $user_id
     * @param String $token_val //当前登录生成的Token值
     * @return mixed
     */
    public function makeUserTokenRecord($user_id, $token_val)
    {
        return $this->redis->set(self::TOKEN_KEY . $user_id, $token_val);
    }

    /**
     * 验证用户的token
     * @param String $token
     * @return bool
     */
    public function userTokenVerificationAndRefreshTime($token)
    {
        $user_id = $this->getKey(self::USER_TOKEN . $token);
        if (!$user_id) return false;
        $user_token = $this->getKey(self::TOKEN_KEY . $user_id);
        //比对token是否符合
        if ($user_token != $token) {
            return false;
        }
        //刷新key过期时间
        $this->redis->setex(self::USER_TOKEN . $token, config('project.token_expiration_time'), $user_id);
        return true;
    }

    public function AppTokenVerifyAndRefresh($token)
    {
        $user_id = $this->getKey(self::APP_LOGIN . $token);
        if (!$user_id) return false;
        $app_token = $this->getKey(self::APP_TOKEN_KEY . $user_id);
        //比对token是否符合
        if ($app_token != $token) {
            return false;
        }
        //刷新key过期时间
        $this->redis->setex(self::APP_LOGIN . $token, 60 * 60 * 24 * 15, $user_id);
        return true;
    }

    /**
     * changeUserCount:改变用户表计数
     * User: hl
     * Date: 2019/1/4
     * Time: 15:13
     * @param int $uid
     * @param array $key
     * @param int $score
     * @return mixed
     */
    public function changeUserCount($uid, $action, $score)
    {
        foreach ($action as $key){
            $this->redis->hincrby(self::USER_TABLE, $uid.':'.$key, $score);
        }
        return true;
    }

    /**
     * getGoodsOfUser:获得用户的浏览记录
     * User: hl
     * Date: 2019/1/4
     * Time: 21:34
     * @param $uid
     * @param $action
     * @param bool $time
     * @return array
     */
    public function getGoodsOfBrowse($uid, $time = false){
        $goods = [];
        if (!$time) $time = date('Y-m-d');
        $today = $this->redis->lrange(self::GOODS_BROWSE.$time, 0, -1);
        dd($time);
        foreach ($today as $v){
            $array = explode(':',$v);
            if (!($uid == $array[0])) continue;
            //if (in_array($array[1],$goods)) continue;
            $goods[] = $array[1];
            unset($array);
        }
        dd($goods);
        return $goods;
    }

    /**
     * getDateByBrowse:获得用户一个月内浏览数
     * User: hl
     * Date: 2019/1/11
     * Time: 18:09
     * @param $uid
     * @return array
     */
    public function getDateByBrowse($uid){
        $date_array = [];
        $date = getDateByPart(Carbon::now()->firstOfMonth(),Carbon::now()->lastOfMonth());
        foreach ($date as $day){
            $day_data = $this->redis->lrange(self::GOODS_BROWSE.$day, 0, -1);
            foreach ($day_data as $v){
                $array = explode(':',$v);
                if ($uid == $array[0] && !in_array($day,$date_array))
                    $date_array[] = $day;
            }
        }
        return $date_array;
    }

    /**
     * setGoodsOfUser:浏览记录设置
     * User: hl
     * Date: 2019/1/4
     * Time: 21:35
     * @param $uid
     * @param $action
     * @param $good
     * @return mixed
     */
    public function setGoodsOfBrowse($uid, $good){
        $time = date('Y-m-d');
        $this->redis->lrem(self::GOODS_BROWSE.$time, 1, $uid.':'.$good);
        $this->redis->lpush(self::GOODS_BROWSE.$time, $uid.':'.$good);
        return $this->redis->expireat(self::GOODS_BROWSE.$time,Carbon::now()->addMonth()->timestamp);
    }

    /**
     * GoodsOfCollect:根据参数操作收藏
     * User: hl
     * Date: 2019/1/9
     * Time: 20:56
     * @param $uid
     * @param $action
     * @param bool $good
     * @return mixed
     */
    public function GoodsOfCollect($uid, $action, $good = false){
        if (!$good) return $this->redis->$action(self::GOODS_COLLECT.$uid);
        return $this->redis->$action(self::GOODS_COLLECT.$uid, $good);
    }
}

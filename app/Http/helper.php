<?php
/**
 * Created by PhpStorm.
 * User: hhb
 * Date: 2018/11/22
 * Time: 11:53
 */


function getEveryDays($day)
{
    $firstday = date('Y-m-d', strtotime("$day +1 day"));
    $lastday = date('Y-m-d', strtotime("$firstday"));
    return array($firstday, $lastday);
}

function getdays($day)
{//指定天的周一和周天
    $lastday = date('Y-m-d', strtotime("$day Sunday"));
    $firstday = date('Y-m-d', strtotime("$lastday -6 days"));
    return array($firstday, $lastday);
}

function getMonths($day)
{//指定月的第一天和最后一天
    $firstday = date('Y-m-01', strtotime($day));
    $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
    return array($firstday, $lastday);

}

if (!function_exists('get_ld_times')) {

    /**
     * 输入开始时间，结束时间，粒度（周，月，季度）
     * @param $st //参数一：开始时间
     * @param $et //参数二：结束时间
     * @param $ld //参数三：粒度（周，月，季度）
     * @return array 时间段字符串数组
     */
    function get_ld_times($st, $et, $ld)
    {
        //日
        if ($ld == 1) {
            $timeArr = array();
            $t1 = $st;
            $t2 = getEveryDays($t1)['1'];
            while ($t2 < $et || $t1 <= $et) {//月为粒度的时间数组
                $timeArr[] = $t1 . ',' . $t2;
                $t1 = date('Y-m-d', strtotime("$t1 +1 day"));
                $t2 = getEveryDays($t1)['1'];
                $t2 = $t2 > $et ? $et : $t2;
            }
            return $timeArr;
            //周
        } elseif ($ld == 2) {
            $timeArr = array();
            $t1 = $st;
            $t2 = getdays($t1)['1'];
            while ($t2 < $et || $t1 <= $et) {//周为粒度的时间数组
                $timeArr[] = $t1 . ',' . $t2;
                $t1 = date('Y-m-d', strtotime("$t2 +1 day"));
                $t2 = getdays($t1)['1'];
                $t2 = $t2 > $et ? $et : $t2;
            }
            return $timeArr;
            //月
        } else if ($ld == 3) {
            $timeArr = array();
            $t1 = $st;
            $t2 = getMonths($t1)['1'];
            while ($t2 < $et || $t1 <= $et) {//月为粒度的时间数组
                $timeArr[] = $t1 . ',' . $t2;
                $t1 = date('Y-m-d', strtotime("$t2 +1 day"));
                $t2 = getMonths($t1)['1'];
                $t2 = $t2 > $et ? $et : $t2;
            }
            return $timeArr;
            //季度
        } else if ($ld == 4) {
            $tStr = explode('-', $st);
            $month = $tStr['1'];
            if ($month <= 3) {
                $t2 = date("$tStr[0]-03-31");
            } else if ($month <= 6) {
                $t2 = date("$tStr[0]-06-30");
            } else if ($month <= 9) {
                $t2 = date("$tStr[0]-09-30");
            } else {
                $t2 = date("$tStr[0]-12-31");
            }
            $t1 = $st;
            $t2 = $t2 > $et ? $et : $t2;
            $timeArr = array();
            while ($t2 < $et || $t1 <= $et) {//月为粒度的时间数组
                $timeArr[] = $t1 . ',' . $t2;
                $t1 = date('Y-m-d', strtotime("$t2 +1 day"));
                $t2 = date('Y-m-d', strtotime("$t1 +3 months -1 day"));
                $t2 = $t2 > $et ? $et : $t2;
            }
            return $timeArr;
        } else {
            return array('参数错误!');
        }
    }
}

if (!function_exists('array_unique_key')) {
    /**
     * 数组根据键名去重
     * @param $array
     * @param $key
     * @return array
     */
    function array_unique_key($array, $key)
    {
        $arr = [];
        foreach ($array as $item => $value) {
            if (!in_array($key, $arr)) {
                $arr[$item] = $array[$item];
            }
        }
        return $arr;
    }
}

if (!function_exists('make_str_rand')) {

    /*
      * 生成随机字符串
      * @param int $length 生成随机字符串的长度
      * @param string $char 组成随机字符串的字符串
      * @return string $string 生成的随机字符串
      */
    function make_str_rand($length = 32, $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        if (!is_int($length) || $length < 0) {
            return false;
        }

        $string = '';
        for ($i = $length; $i > 0; $i--) {
            $string .= $char[mt_rand(0, strlen($char) - 1)];
        }

        return $string;
    }
}

if (!function_exists('getOffset')) {

    /**
     * 页码转换为偏移量
     * @param $page
     * @param int $pageSize
     * @return float|int
     */
    function getOffset($page, $pageSize = 10)
    {
        $page = $page == 0 ? 1 : $page;
        $offset = ($page - 1) * $pageSize;
        return $offset;
    }
}

if (!function_exists('returnJson')) {
    function returnJson($data = '',$code = 200,$message = null)
    {
        $result['code'] = $code == 200 | $code == '' ? 200 : $code;
        $result['status'] = $code == 200 | $code == '' ? 'success' : 'error';
        $result['msg'] = $message;
        $result['data'] = $data;
        return response(
            json_encode($result),
            200,
            [
                'content-type' => 'application/json',
                'accept' => 'application/json',
            ]);
    }
}


if (!function_exists('encryptString')) {

    /**
     * 加密数据
     * @param $value
     * @return string
     */
    function encryptString($value)
    {
        $key = '0102030405060708';
        $data['iv'] = base64_encode('0102030405060708');
        $data['value'] = openssl_encrypt($value, 'AES-128-CBC', $key, 0, base64_decode($data['iv']));
        $encrypt = base64_encode(json_encode($data));
        return $encrypt;
    }
}

if (!function_exists('decryptString')) {

    /**
     * 解密数据
     * @param $value
     * @return string
     */
    function decryptString($value)
    {
        $key = "0102030405060708";
        $encrypt = json_decode(base64_decode($value), true);
        $iv = $encrypt['iv'];
        $decrypt = trim(openssl_decrypt($encrypt['value'], 'AES-128-CBC', $key, 0, base64_decode($iv)));
        return $decrypt;
    }
}

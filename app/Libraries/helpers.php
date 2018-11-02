<?php
use Illuminate\Support\Facades\Route;
if (!function_exists('copyFile')) {
    function copyFile($fileUrl, $aimUrl, $overWrite = false) {
        if (!file_exists($fileUrl)) {
            return false;
        }
        if (file_exists($aimUrl) && $overWrite == false) {
            return false;
        } elseif (file_exists($aimUrl) && $overWrite == true) {
            unlinkFile($aimUrl);
        }
        $aimDir = dirname($aimUrl);
        copy($fileUrl, $aimUrl);
        return true;
    }
}
if (!function_exists('rmkdir')) {
    function rmkdir($dir)
    {
        if ($dir == "/") {
            exit();
        }
        if (is_dir($dir)) {
            rrmdir($dir);
        }
        mkdir($dir);
    }
}
if (!function_exists('rrmdir')) {
    function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") rrmdir($dir . "/" . $object); else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}
if (!function_exists('unlinkFile')) {
    function unlinkFile($aimUrl)
    {
        if (file_exists($aimUrl)) {
            unlink($aimUrl);
            return true;
        } else {
            return false;
        }
    }
}

/**
 * 遍历该目录下的文件
 */
if (!function_exists('dir_list')) {
     function dir_list($pathStr){
        $res = array();
        $path = scandir($pathStr);
        foreach($path as $p){
            if($p == "." || $p == ".."){
                continue;
            }
            if(is_dir($pathStr."/".$p)){
                $arr = dir_list($pathStr."/".$p);
                $res = array_merge($res,$arr);
            }
            else{
                $res[] = $pathStr."/".$p;
            }
        }
        return $res;
    }
}

/**
 * 判断是否为图片
 */

if (!function_exists('isImage')) {
 function isImage($filename){
    $types = "image/gif|image/jpeg|image/png|image/bmp";
    if(file_exists($filename)){
        $info = getimagesize($filename);
        return stripos($types,$info['mime']);
    }else{
        return false;
    }
}
}

if (!function_exists('generate_sign')) {
	/**
	 * 微信支付生成签名
	 * @param array $attributes
	 * @param $key
	 * @param string $encryptMethod
	 * @return string
	 */
	function generate_sign(array $attributes, $key, $encryptMethod = 'md5')
	{
		ksort($attributes);
		$attributes['key'] = $key;
		return strtoupper(call_user_func_array($encryptMethod, [urldecode(http_build_query($attributes))]));
	}
}
if (!function_exists('is_mobile')) {

    /**
     * 验证是否为手机号
     * @param string $mobile
     * @return bool
     */
    function is_mobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        if (preg_match('/^1\d{10}$/', $mobile)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('is_email')) {

    /**
     * 验证邮件地址
     *
     * @param string $email 需要验证的邮件地址
     * @return bool
     */
    function is_email($email)
    {
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,5}\$/i";
        if (strpos($email, '@') !== false && strpos($email, '.') !== false) {
            if (preg_match($chars, $email)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('xml_to_array')) {

    /**
     * xml转数组
     *
     * @author lxp 20170304
     * @param string $xml
     * @return array
     */
    function xml_to_array($xml)
    {
        if (!$xml) {
            return [];
        }
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $array = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array;
    }
}

if (!function_exists('card_num_hidden')) {
    /**
     * 证件号码，手机号码隐藏
     * @param string $num
     * @param int $f_len
     * @param int $l_len
     * @return string
     */
    function card_num_hidden($num, $f_len = 3, $l_len = 4)
    {
        $num_hidden = '';
        for ($i = 0; $i < strlen($num); $i++) {
            if ($i < $f_len || $i > strlen($num) - 1 - $l_len) {
                $num_hidden .= $num[$i];
            } else {
                $num_hidden .= '*';
            }
        }
        return $num_hidden;
    }
}

if (!function_exists('is_idcard')) {
    /**
     * 身份证号验证
     * @param string $idcard
     * @param bool $return_bool 是否返回bool值
     * @return bool|array
     */
    function is_idcard($idcard, $return_bool = false)
    {
        $idcard = strtoupper($idcard);

        $city = [
            11 => "北京",
            12 => "天津",
            13 => "河北",
            14 => "山西",
            15 => "内蒙古",
            21 => "辽宁",
            22 => "吉林",
            23 => "黑龙江",
            31 => "上海",
            32 => "江苏",
            33 => "浙江",
            34 => "安徽",
            35 => "福建",
            36 => "江西",
            37 => "山东",
            41 => "河南",
            42 => "湖北",
            43 => "湖南",
            44 => "广东",
            45 => "广西",
            46 => "海南",
            50 => "重庆",
            51 => "四川",
            52 => "贵州",
            53 => "云南",
            54 => "西藏",
            61 => "陕西",
            62 => "甘肃",
            63 => "青海",
            64 => "宁夏",
            65 => "新疆",
            71 => "台湾",
            81 => "香港",
            82 => "澳门",
            91 => "国外"
        ];

        if (!$idcard || !preg_match('/^\d{6}(18|19|20)?\d{2}(0[1-9]|1[012])(0[1-9]|[12]\d|3[01])\d{3}(\d|X)$/i', $idcard)) {
            return false;
        } else if (!isset($city[substr($idcard, 0, 2)])) {
            return false;
        } else {
            //18位身份证需要验证最后一位校验位
            if (mb_strlen($idcard) == 18) {
                $codeArray = str_split($idcard);
                //加权因子
                $factor = [
                    7,
                    9,
                    10,
                    5,
                    8,
                    4,
                    2,
                    1,
                    6,
                    3,
                    7,
                    9,
                    10,
                    5,
                    8,
                    4,
                    2
                ];
                //校验位
                $parity = [
                    1,
                    0,
                    'X',
                    9,
                    8,
                    7,
                    6,
                    5,
                    4,
                    3,
                    2
                ];
                $sum = 0;
                $ai = 0;
                $wi = 0;
                for ($i = 0; $i < 17; $i++) {
                    $ai = $codeArray[$i];
                    $wi = $factor[$i];
                    $sum += $ai * $wi;
                }
                $last = $parity[$sum % 11];
                if ($parity[$sum % 11] != $codeArray[17]) {
                    return false;
                }
            }
        }

        if ($return_bool) {
            return true;
        } else {
            return [
                'city' => $city[substr($idcard, 0, 2)],
                'age' => date('Y') - substr($idcard, 6, 4),
                'sex' => (substr($idcard, 16, 1) % 2 == 0) ? 2 : 1,
                'birthday' => substr($idcard, 10, 2) . '-' . substr($idcard, 12, 2)
            ];
        }
    }
}


if (!function_exists('m_mkdir')) {
    /**
     * 创建目录，并设置权限
     *
     * @author lxp 20171103
     * @param $dir
     * @param int $mode
     */
    function m_mkdir($dir, $mode = 0777)
    {
        if ($dir && !is_dir($dir)) {
            @mkdir($dir, $mode, true);
            @chmod($dir, $mode);
        }
    }
}

include_once 'helpers_api.php';
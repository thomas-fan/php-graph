<?php


namespace src;


class Util
{
    /**
     * 获取一个 order x order 的二维数组，初始值默认为 0
     * @param string $order 阶数
     * @param int $init 初始值
     * @return array
     */
    public static function get2dArray(string $order, $init = 0): array
    {
        $result = [];
        if ($order < 1) {
            return $result;
        }
        for ($i = 0; $i < $order; $i++) {
            for ($j = 0; $j < $order; $j++) {
                $result[$i][$j] = $init;
            }
        }
        return $result;
    }

    /**
     * 将逗号、空格、回车的字符串转换成数组
     * @param string $str 原始字符串
     * @return array
     */
    public static function strToArray(string $str)
    {
        $result = [];
        $str = str_replace(',', ',', $str);
        $str = str_replace("\n", ',', $str);
        $str = str_replace("\r\n", ',', $str);
        $str = str_replace(' ', ',', $str);
        $array = explode(',', $str);
        foreach ($array as $key => $value) {
            if ('' != ($value = trim($value))) {
                $result[] = $value;
            }
        }
        return $result;
    }
}
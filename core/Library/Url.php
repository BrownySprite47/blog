<?php
/**
 * Created by PhpStorm.
 * User: BestUser1
 * Date: 12.04.2018
 * Time: 10:45
 */

namespace Library;


class Url
{
    /**
     * @return array
     */
    protected static function getSegmentsFromUrl()
    {
        $segments = explode('/', $_GET['urn']);

        if(empty($segments[count($segments) - 1])){
            unset($segments[count($segments) - 1]);
        }
        return $segments;
    }

    /**
     * @param $paramName
     * @return string
     */
    public static function getParam($paramName)
    {
        return addslashes($_GET[$paramName]);
    }

    /**
     * @param $n
     * @return mixed
     */
    public static function getSegment($n)
    {
        $segments = self::getSegmentsFromUrl();
        $segments = array_map(function($v){
            return preg_replace('/[\'\"\\\*]/', '', $v);
        }, $segments);
        return $segments[$n];
    }

    /**
     * @return array
     */
    public static function getAllSegments()
    {
        $segments = self::getSegmentsFromUrl();
        $segments = array_map(function($v){
            return preg_replace('/[\'\"\\\*]/', '', $v);
        }, $segments);
        return $segments;
    }
}


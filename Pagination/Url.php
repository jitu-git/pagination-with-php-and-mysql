<?php

namespace Pagination;


class Url {

    protected static $url;
    public static $pageString = "page";

    /**
     * @return string
     */
    public static function currentUrl(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $current_url = $protocol. $_SERVER["HTTP_HOST"]. $_SERVER["REQUEST_URI"];
    }


    /**
     * @param int $page
     * @return string
     */
    public static function setUrl($page = 1){
        if($page == Url::activePage()){
            return "javascript:void(0)";
        }
        $check_page = parse_url(self::currentUrl());
        if(isset($check_page["query"])){
            parse_str($check_page["query"],$pages);
            if(array_key_exists(self::$pageString,$pages)){
                $pages[self::$pageString] = $page;
            }
            $query_string = http_build_query($pages);
            return $check_page["scheme"]. "://". $check_page["host"]. $check_page["path"]. "?". $query_string;
        }else{
            $pages[self::$pageString] = $page;
            $query_string = http_build_query($pages);
            return self::currentUrl(). "?". $query_string;
        }
    }

    public static function activePage(){
        return isset($_GET[self::$pageString]) && $_GET[self::$pageString] != "" ? $_GET[self::$pageString] : 1;
    }
}
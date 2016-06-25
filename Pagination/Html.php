<?php

namespace Pagination;

use Pagination\Url as Url;

class Html{
    public function __construct(){

    }
    /**
     * @param int $page
     * @param string $title
     * @return string
     */
    public  static function generate_link($page = 0,$title = null){
        $title =  !is_null($title) ? $title : $page;
        if($page == Url::activePage()){
            return $title;
        }
        return '<a href="'. Url::setUrl($page) .'">'. $title.'</a>';
    }
}
?>
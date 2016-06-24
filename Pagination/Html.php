<?php

namespace Pagination;

class Html extends Pagination{
    public function __construct(){

    }

    /**
     * @param int $page
     * @param string $title
     * @return string
     */
    public  function generate_link($page = 0,$title = null){
        $title =  !is_null($title) ? $title : $page;
        if($page == $this->currentPage()){
            return $title;
        }
        return '<a href="'. $this->_setUrl($page) .'">'. $title.'</a>';
    }
}
?>
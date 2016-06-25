<?php
namespace Pagination;

use Pagination\Html as Html;
use Pagination\Sql as Sql;
use Pagination\Url as Url;

class Pagination{

    public $pageString = "page";

    public $total, $currentPage, $limit, $totalPage;

    public function __construct($limit){
        Sql::$limit = $this->limit = $limit;
    }

    /**
     * count total no. of pages
     *
     * @return float
     */
    private function total_no_page(){
        return $this->totalPage = $this->total() / $this->limit;
    }


    public function total(){
        return Sql::total();
    }

    /**
     * generate pagination links
     */

    public function links(){
        for($i = 1; $i <= $this->total_no_page(); $i++){
            echo Html::generate_link($i);
        }
    }

    /**
     * get first page link
     *
     * @return string
     */
    public function first(){
        return Html::generate_link(1,"First");
    }

    /**
     * get last page link
     *
     * @return string
     */
    public function last(){
        return Html::generate_link($this->totalPage,"Last");
    }

    /**
     * generate next page link
     *
     * @return bool|string
     */
    public function next(){
        return $this->currentPage < $this->totalPage ? Html::generate_link($this->currentPage()+1,"Next") : false;
    }

    /**
     * generate previous page link
     *
     * @return bool|string
     */
    public function previous(){
        return $this->currentPage > 1 ? Html::generate_link($this->currentPage()-1,"Previous") : false ;
    }

    /**
     * @return int
     */
    public function currentPage(){
        return $this->currentPage = Url::activePage();
    }

    /**
     *
     * @param $string
     */
    public function _pagination($string){
        $this->pageString = isset($string) && !is_null($string) ? $string : $this->pageString;
    }

    public function sql($query){
        Sql::setSql($query);
    }

    public function results(){
        return Sql::getResults();
    }

    /**
     * set url for pagination
     *
     * @param null $url
     * @return null|string
     */
    public function url($url = null){
        return !is_null($url) ? $url : Url::currentUrl();
    }
}
?>
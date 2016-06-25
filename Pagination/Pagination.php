<?php
namespace Pagination;

use Pagination\Html as Html;
use Pagination\Sql as Sql;
use Pagination\Url as Url;

class Pagination{

    public $pageString = "page";

    public $total, $limit, $totalPage;

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
     *
     * @param array $attributes
     */
    public function links($attributes = array()){
        echo Html::wrapper("start");

        if($this->total_no_page() > 10){
            $start = ($this->currentPage() - 5) <= 1 ? 1 : ($this->currentPage() - 5);
            $end = ($this->currentPage() + 5) >= $this->totalPage ? $this->totalPage  : ($this->currentPage() + 5 );
            for($i = $start; $i <= $end ; $i++){
                echo Html::generate_link($i,null,$attributes);
            }
        }else{
            for($i = 1; $i <= $this->total_no_page(); $i++){
                echo Html::generate_link($i,null,$attributes);
            }
        }
        echo Html::wrapper("end");
    }

    /**
     * get first page link
     *
     * @param null $title
     * @param array $attributes
     * @return string
     */
    public function first($title = null, $attributes = array()){
        $title = is_null($title) || $title == '' ? "First" : $title;
        return Html::link(1,$title,$attributes);
    }

    /**
     * get last page link
     *
     * @param null $title
     * @param array $attributes
     * @return string
     */
    public function last($title = null,$attributes = array()){
        $title = is_null($title) || $title == '' ? "Last" : $title;
        return Html::link($this->totalPage,$title,$attributes);
    }

    /**
     * generate next page link
     *
     * @param null $title
     * @param array $attributes
     * @return bool|string
     */
    public function next($title = null,$attributes = array()){
        $title = is_null($title) || $title == '' ? "Next" : $title;
        return $this->currentPage() < $this->totalPage ? Html::link($this->currentPage()+1,$title,$attributes) : false;
    }

    /**
     * generate previous page link
     *
     * @param null $title
     * @param array $attributes
     * @return bool|string
     */
    public function previous($title = null,$attributes = array()){
        $title = is_null($title) || $title == '' ? "Previous" : $title;
        return $this->currentPage() > 1 ? Html::link($this->currentPage()-1,$title,$attributes) : false ;
    }

    /**
     * @return int
     */
    public function currentPage(){
        return Url::activePage();
    }

    /**
     *
     * @param $string
     */
    public function _pagination($string = null){
       Url::$pageString = $this->pageString = isset($string) && !is_null($string) ? $string : $this->pageString;
    }

    /**
     * set sql query given by user
     *
     * @param $query
     */
    public function sql($query){
        Sql::setSql($query);
    }

    /**
     * return all results from database
     *
     * @return array
     */
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

    /**
     * starting no. of records
     *
     * @return int
     */
    public function start(){
        return Sql::start_results() + 1;
    }

    public function end(){
        return Sql::start_results()  + Sql::$limit;
    }
}
?>
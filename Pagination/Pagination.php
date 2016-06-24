<?php
namespace Pagination;

use Pagination\Html as Html;

class Pagination{

    public $pageString = "page";

    public $total, $currentPage, $nextPage, $previousPage, $sqlString, $limit, $totalPage;

    private $html;

    public function __construct($limit){

        $this->total = 50;
        $this->limit = $limit;
        $this->html = new Html();
        $this->total_no_page();
        $this->currentPage();
    }

    private function total_no_page(){
        $this->totalPage = $this->total / $this->limit;
    }

    public function number(){

    }

    public function links(){
        for($i = 1; $i <= $this->totalPage; $i++){
            echo $this->html->generate_link($i);
        }
    }

    /**
     * get first page link
     *
     * @return string
     */
    public function first(){
        return $this->html->generate_link(1,"First");
    }

    /**
     * get last page link
     *
     * @return string
     */
    public function last(){
        return $this->html->generate_link($this->totalPage,"Last");
    }

    public function next(){
        return $this->currentPage < $this->totalPage ? $this->html->generate_link($this->currentPage()+1,"Next") : false;
    }

    public function previous(){
        return $this->currentPage > 1 ? $this->html->generate_link($this->currentPage()-1,"Previous") : false ;
    }

    /**
     * @return int
     */
    public function currentPage(){
        return $this->currentPage = isset($_GET[$this->pageString]) ? $_GET[$this->pageString] : 1;
    }

    /**
     *
     * @param $string
     */
    public function _pagination($string){
        $this->pageString = isset($string) && !is_null($string) ? $string : $this->pageString;
    }

    public function setSql(){

    }

    /**
     * set url for pagination
     *
     * @param null $url
     * @return null|string
     */
    public function url($url = null){
        return !is_null($url) ? $url : $this->currentUrl();
    }

    /**
     * @return string
     */
    private function currentUrl(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $current_url = $protocol. $_SERVER["HTTP_HOST"]. $_SERVER["REQUEST_URI"];
    }
    /**
     * set url of pages
     *
     * @param $page
     * @return string
     */
    protected function _setUrl($page){
        $check_page = parse_url($this->currentUrl());
        if($check_page){
            parse_str($check_page["query"],$pages);
            if(array_key_exists($this->pageString,$pages)){
                $pages[$this->pageString] = $page;
            }
            $query_string = http_build_query($pages);
            return $check_page["scheme"]. "://". $check_page["host"]. $check_page["path"]. "?". $query_string;
        }else{
            return $this->currentUrl(). "?". $this->pageString. "=". $page;
        }
    }
}
?>
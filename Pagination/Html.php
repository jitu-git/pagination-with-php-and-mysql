<?php

namespace Pagination;

use Pagination\Url as Url;

class Html{

    /**
     * @param int $page
     * @param null $title
     * @param array $attributes
     * @return int|null|string
     */
    public static function generate_link($page = 0,$title = null, $attributes = array()){
        $title =  !is_null($title) ? $title : $page;
        $inner_tag_attributes = array();
        if($page == Url::activePage()){
            $inner_tag_attributes["class"] = "active";
        }
        return self::inner_tag("start",$inner_tag_attributes) . self::link($page,$title, $attributes). self::inner_tag("end");
    }


    public static function link($page = 0,$title = null, $attributes = array()){
        return '<a href="'. Url::setUrl($page) .'" '. self::html()->attributes($attributes) .'>'. $title.'</a>';
    }
    /**
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     * @return string
     */

    public function attributes($attributes){
        $html = [];
        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);
            if (! is_null($element)) {
                $html[] = $element;
            }
        }
        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function attributeElement($key, $value){
        if (is_numeric($key)) {
            $key = $value;
        }

        if (! is_null($value)) {
            return $key . '="' . $this->e($value) . '"';
        }
    }

    /**
     * Escape HTML entities in a string.
     *
     * @param  string $value
     * @return string
     */
    function e($value){
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }

    /**
     * create object of Html class
     *
     * @return Html
     */
    private static function html(){
        return new Html();
    }

    /**
     * @param $type
     * @return string
     */
    public static function wrapper($type){
        switch ($type){
            case "start":
                return '<ul class="pagination">';
            break;
            case "end":
                return "</ul>";
            break;
        }
    }

    /**
     * @param $type
     * @param array $attributes
     * @return string
     */
    public static function inner_tag($type,$attributes = array()){
        switch ($type){
            case "start":
                return '<li '. self::html()->attributes($attributes) .'>';
                break;
            case "end":
                return "</li>";
                break;
        }
    }
}
?>
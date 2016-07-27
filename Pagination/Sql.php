<?php

namespace Pagination;

class Sql {

    public static $sqlString, $limit;

    /**
     * prepare sql query
     *
     * @return array
     */
    public static function getResults(){
        return self::results(self::prepare_query(self::$sqlString. ' LIMIT '. self::start_results() . ',' . self::$limit));
    }

    /**
     *
     * @return int
     */
    public static function start_results(){
        return ((Url::activePage() - 1) * self::$limit);
    }
    /**
     * connect database
     * @method connect_db
     */
    private static function connect_db(){
        mysql_connect("localhost","root","");
        mysql_select_db("test");
    }

    /**
     * close db connection
     *
     * @method close_db
     */
    private static function close_db(){
        mysql_close();
    }

    /**
     * prepare sql query
     *
     * @param string $query
     * @return resource
     */
    private static function prepare_query($query = ""){
        self::connect_db();
        $sql_query = isset($query) && $query != "" ? $query : self::$sqlString;
        return mysql_query($sql_query);
    }
    /**
     * @param $sql_query
     * @return array
     */
    public static function setSql($sql_query){
        self::$sqlString = $sql_query;
    }

    /**
     * get results from db
     *
     * @param $sql
     * @return array
     */
    private static function results($sql){
        $result = [];
        while($results = mysql_fetch_assoc($sql)){
            $result[] = $results;
        }
        self::close_db();
        return $result;
    }

    /**
     * return total no. of results from database
     *
     * @return int
     */
    public static function total(){
        return mysql_num_rows(self::prepare_query());
    }
}
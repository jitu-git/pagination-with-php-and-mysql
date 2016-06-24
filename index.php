<?php
require_once "Pagination/autoload.php";
$pagination = new \Pagination\Pagination(5);

/*echo "<pre>";
print_r($pagination);*/

//echo $pagination->first();
//echo $pagination->last();
$pagination->links();
echo "</br>";
echo $pagination->next();
echo $pagination->previous();



?>
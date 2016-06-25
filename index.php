<?php
require_once "Pagination/autoload.php";
$pagination = new \Pagination\Pagination(5);

$pagination->sql("SELECT * FROM dummy");

?>
<table border="1">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>City</th>
    </tr>
    <?php
    foreach($pagination->results() as $users){
        ?>
        <tr>
            <td><?php echo $users["id"] ?></td>
            <td><?php echo $users["name"] ?></td>
            <td><?php echo $users["city"] ?></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
$pagination->links();
echo "</br>";
echo $pagination->next();
echo $pagination->previous();

echo "</br>";
echo "CurrentPage : ".$pagination->currentPage();
echo "</br>";
echo "Current Page  URL: ".$pagination->url();
echo "</br>";
echo "Total Page: ".$pagination->totalPage;
echo "</br>";
echo "Total Result: ".$pagination->total();

?>
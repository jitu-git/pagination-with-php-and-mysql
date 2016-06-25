<?php
require_once __DIR__ . "../../Pagination/autoload.php";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Pagination with PHP and Mysql</title>
</head>
<body>
<?php
$pagination = new \Pagination\Pagination(10);
$pagination->sql("SELECT * FROM dummy");
?>
<div class="col-md-12">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>City</th>
        </tr>
        <?php
        $start = $pagination->start();
        foreach($pagination->results() as $users){
            ?>
            <tr>
                <td><?php echo $start++; ?></td>
                <td><?php echo $users["name"]; ?></td>
                <td><?php echo $users["city"]; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
<?php
$pagination->links();
echo "</br>";
echo $pagination->previous("<<",array("class" => "btn btn-default"));
echo $pagination->next(">>",array("class" => "btn btn-warning"));

echo "</br>";
echo "Start: ".$pagination->start();
echo "</br>";
echo "End : ".$pagination->end();
echo "</br>";
echo "CurrentPage : ".$pagination->currentPage();
echo "</br>";
echo "Current Page  URL: ".$pagination->url();
echo "</br>";
echo "Total Page: ".$pagination->totalPage;
echo "</br>";
echo "Total Result: ".$pagination->total();
?>
</body>
</html>

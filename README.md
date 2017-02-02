#Pagination with PHP and MYSQL
This is a simple pagination class which generate pagination links for database results.

Download a fresh copy of pagination class and put Pagination folder in your project directory.

Include autoload.php in your file.

    require_once __DIR__ . "../../Pagination/autoload.php"
That's it. Now create an object of pagination class.

    $limit = 10;
    $pagination = new \Pagination\Pagination($limit);
To get results from database call `sql()` and put your sql query without limit.

    $pagination->sql("SELECT * FROM dummy");
    $pagination->results();
And for generate pagination links call 

    $pagination->links();
There are so many other function for different links;

    echo "Start: ".$pagination->start();
    echo "End : ".$pagination->end();
    echo "CurrentPage : ".$pagination->currentPage();
    echo "Current Page  URL: ".$pagination->url();
    echo "Total Page: ".$pagination->totalPage;
    echo "Total Result: ".$pagination->total();


[Demo](https://www.maxmarks.in/demo/pagination-with-php-and-mysql/)

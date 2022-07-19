<?php
$title = 'Blog';
require_once 'partials/_header.php';

$posts = posts_with_search_query(2)[0];
$totalPages = posts_with_search_query(2)[1];
$allCategories = get_all_data('category', 'created_at', 12);

?>

<?php require_once 'views/_blog.php' ?>
    
<?php require_once 'partials/_footer.php'?>
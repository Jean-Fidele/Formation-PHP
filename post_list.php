<?php
$title = 'Liste des articles';
require_once 'partials/_header.php';

if (!logged_in()) redirect_to('login.php');

$posts = posts_with_search_query(10)[0];
$totalPages = posts_with_search_query(10)[1];
?>

<?php require_once 'views/_post_list.php'?>

<?php require_once 'partials/_footer.php'; ?>

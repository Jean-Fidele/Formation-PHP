<?php
$title = $post->title;
require_once 'partials/_header.php'; //Inclusion du header

if (!isset($_GET['id'])) redirect_to('blog.php');
$id = (int)$_GET['id'];

$post = get_single_join_post($id); //Récupération des articles avec informations liées
if (!$post) redirect_to('blog.php');
$categories = get_categories_for_articles($id); //Recuperation des catégories pour un article
$comments = get_comments_for_article($id); //Récupération des commentaires d'un article

//Début du traitement navigation article précédent article suivant
$posts = get_all_data('post', 'created_at');
$postsList = []; //Stocker tous les id des articles dans un tableau
foreach ($posts as $postId) {
    $postsList[] = $postId->id;
}
$key = array_search($id, $postsList); //Clé de l'article en cour
$prev = $postsList[$key - 1] ?? 0; //id de l'article précédent
$next = $postsList[$key + 1] ?? 0; //id de l'article suivant
$prevPost = get_single_data('post', $prev); //Article précédent
$nextPost = get_single_data('post', $next); //Article suivant

$errors = [];
if (isset($_POST['add_comment'])) {
    $submit = array_pop($_POST);
    $_POST = sanitize($_POST);
    extract($_POST);
    if (!not_empty($comment)) {
        $errors['comment'] = "Champ obligatoire.";
    }

    if (empty($errors)) {
        $q = $db->prepare("INSERT INTO comment (name, firstname, email, comment, created_at, post_id) VALUES (?, ?, ?, ?, NOW(), ?)");
        $state = $q->execute([$name, $firstname, $email, $comment, $id]);
        if ($state) {
            $_SESSION['success'] = 'Merci pour votre avis';
            redirect_to('single.php?id=' . $id . '#comment-area');
        }
    }
}


require_once 'views/_single.php';

require_once 'partials/_footer.php';
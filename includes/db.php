<?php

define('WEBSITE_NAME', 'Coding City Lite');
define('WEBSITE_URL', 'http://localhost:8000');
define('BASE_FILE_ROOT', 'uploads');
define('DEFAULT_PROFILE_PIC', 'cc_default.png');


$host = 'mysql:host=127.0.0.1;dbname=php_11';
$user = 'root';
$password = '';

try {
    $db = new PDO($host, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}


function get_all_data(string $table, $order = 'id', int $limit = null)
{
    global $db;
    $sql = "SELECT * FROM $table ORDER BY $order DESC ";
    if ($limit > 0) {
        $sql .= "LIMIT $limit";
    }
    $q = $db->prepare($sql);
    $q->execute();
    return $q->fetchAll(PDO::FETCH_OBJ);
}

function get_single_data(string $table, $id)
{
    global $db;
    $q = $db->prepare("SELECT * FROM $table WHERE id = :id");
    $q->execute(['id' => $id]);
    return $q->fetch(PDO::FETCH_OBJ);
}

function get_single_join_post($id)
{
    global $db;
    $q = $db->prepare(
        "SELECT p.id, title, content, p.image post_image, p.created_at, u.name, u.firstname, u.role, ua.other, ua.image user_image 
                FROM post p 
                    LEFT JOIN user u 
                        ON p.user_id = u.id 
                    LEFT JOIN user_add ua 
                        on u.id = ua.user_id 
                WHERE p.id = :id"
    );
    $q->execute(['id' => $id]);
    return $q->fetch(PDO::FETCH_OBJ);
}

function get_categories_for_articles(int $id)
{
    global $db;
    $q = $db->prepare("SELECT title FROM post_category pc JOIN category c ON pc.category_id = c.id WHERE pc.post_id = :id");
    $q->execute(['id' => $id]);

    return $q->fetchAll(PDO::FETCH_OBJ);
}

function get_comments_for_article(int $id) {
    global $db;
    $q = $db->prepare("SELECT c.id, name, firstname, comment, c.image, c.created_at FROM comment c left join post p on c.post_id = p.id WHERE c.post_id = :id ORDER BY created_at DESC");
    $q->execute(['id' => $id]);

    return $q->fetchAll(PDO::FETCH_OBJ);
}


/**
 * Permet de recupérer les articles dans la table artcile tout en récupérant les information sur l'auteur de l'article
 * Prend également en compte le facteur recherche.
 * La recherche ne prend en compte que le nom, le prénom de l'auteur et aussi le titre de l'article
 *
 * @param int $perPage Nombre d'élements qu'on aimerai afficher sur une page
 *
 * @return array|null Renvoie un tableau contenant en première valeur le nombre d'artcile et en deuxième valeur
 *                    le nombre total des pages sur lesquelles nos articles s'étendront
 */
function posts_with_search_query(int $perPage = 2)
{
    global $db;
    $query = "SELECT p.id, p.title, p.created_at, content, image, name, firstname
    FROM post p
        JOIN user u 
            on p.user_id = u.id
";
    $queryCount = "SELECT COUNT(p.id) as count 
    FROM post p 
        JOIN user u 
            ON p.user_id = u.id";
    $params = [];

    //Gestion des paramètre de la recherche
    if (!empty($_GET['q'])) {
        $query .= " WHERE p.title LIKE :q OR name LIKE :q OR firstname LIKE :q";
        $queryCount .= " WHERE p.title LIKE :q OR name LIKE :q OR firstname LIKE :q";
        $params['q'] = "%{$_GET['q']}%";
    }

    //Gestion des paramètre de la pagination
    $page = (int)($_GET['p'] ?? 1);
    $offset = ($page - 1) * $perPage;

    $query .= " ORDER BY created_at DESC LIMIT $perPage OFFSET $offset";

    $q = $db->prepare($query);
    $q->execute($params);
    $posts = $q->fetchAll(PDO::FETCH_OBJ);

    $q = $db->prepare($queryCount);
    $q->execute($params);
    $totalElements = (int)$q->fetch()['count']; //Nombre Total des éléments provenant de la bdd
    $totalPages = ceil($totalElements / $perPage); //Nombre total de page sur lesquelles tout les éléments seront afficher

    if (count($posts) > 0) return [$posts, $totalPages];

    return null;
}
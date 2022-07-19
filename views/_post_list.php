<?php require_once 'display-header.php' ?>

<?= display_header('Liste des Articles', 'clipboard-list') ?>

<section class="py-5">
    <div class="container-fluid">
        <?= display_session_alert(); ?>
        <?= display_session_alert('warning'); ?>
        <?= display_session_alert('info'); ?>


            <div class="card">
                <div class="card-header  bg-dark text-light">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="fs-2 mb-2 b-title text-start">Liste des articles</h1>
                        </div>
                        <div class="col-md-4">
                            <form action="<?= $_SERVER['PHP_SELF'] ?>">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control rounded-0" placeholder="Rechercher..." aria-label="Rechercher..." aria-describedby="basic-addon1" name="q" value="<?= get_get_data($_GET, 'q') ?>">
                                    <button class="btn btn-outline-success input-group-text rounded-0" id="basic-addon1"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php if(empty($posts)): ?>
                    <div class="col-md-8 mx-auto">
                        <h1 class="fs-2 mb-2 b-title text-start">Aucun article pour le moment</h1>
                    </div>
                <?php else: ?>
                <div class="card-body border-top border-orange">
                    <table class="table table-striped table-hover">
                        <thead class="text-uppercase fw-bold">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titre et image</th>
                                <th scope="col">Contenu</th>
                                <th scope="col">Catégories</th>
                                <th scope="col">Commentaires</th>
                                <th scope="col">Date Création </th>
                                <th scope="col">Auteur</th>
                                <th scope="col">Actions</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($posts as $post): ?>
                                <?php
                                    $fullName = $post->name .' '. $post->firstname;
                                    $categories = get_categories_for_articles($post->id);
                                    $comments = get_comments_for_article($post->id);
                                ?>
                                <tr>
                                    <td scope="row"><?= $post->id ?></td scope="row">
                                    <td class="fw-bold">
                                        <a href="single.php?id=<?= $post->id ?>">
                                            <h6><?= $post->title ?></h6>
                                            <img src="<?= $post->image ?>" alt="" class="img-list">
                                        </a>

                                    </td>
                                    <td><?= mb_substr($post->content, 0, 60) ?></td>
                                    <td>
                                        <?php foreach ($categories as $category) {
                                            echo $category->title .', ';
                                        } ?>
                                    </td>
                                    <td><span class="badge bg-primary"><?= number_display($comments) ?></span> </td>
                                    <td><?= time_format($post->created_at) ?></td>
                                    <td><?= $fullName ?></td>
                                    <td>
                                        <a href="post_edit.php?id=<?= $post->id ?>" class="btn btn-sm btn-primary rounded-0"><i class="fas fa-edit"></i></a>
                                        <a href="post_delete.php?id=<?= $post->id ?>" onclick="return(confirm('Confirmer la suppression de cet élément'))" class="btn btn-sm btn-danger rounded-0"><i class="fas fa-trash-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-dark rounded-0" data-bs-toggle="modal" data-bs-target="#<?= str_replace(' ', '', $post->title.$post->id) ?>"><i class="fas fa-info-circle"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <nav class="blog-pagination mb-2"><!-- Pagination -->
                    <ul class="cc-pagination">
                        <?= display_pagination($totalPages)?>
                    </ul>
                </nav><!-- End pagination -->

                <?php endif; ?>
            </div>

            <div class="category-info">
                <!-- Modal -->
                <?php foreach($posts as $post): ?>
                    <div class="modal fade" id="<?= str_replace(' ', '', $post->title.$post->id) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?= $post->title ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Article N° <?= $post->id ?> crée le <?= time_format($post->created_at) ?> par <?= $fullName ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    </div>
</section>
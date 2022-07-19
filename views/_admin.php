<?php require_once 'display-header.php' ?>

<?= display_header('Tableau de bord', 'tachometer-alt') ?>
<section class="">
    <div class="row me-0">
        <div class="col-md-2">
            <div class="d-flex flex-column p-3 text-white bg-dark h-100">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" aria-current="page">
                            <i class="fas fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="fas fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="fas fa-table"></i>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="fas fa-th-large"></i>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="fas fa-user-circle"></i>
                            Customers
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="container-fluid py-5">
                <div class="row mx-0">
                    <div class="col-md-3 mb-4">
                        <div class="card text-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h1 class="fw-bold mb-0">15206</h1>
                                        <h6 class="text-muted">Articles</h6>
                                    </div>
                                    <div class="col-4">
                                        <h2 class="text-center fs-1">
                                            <i class="fas fa-clipboard-list"></i>
                                        </h2>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a href="" class="link-info">Liste des posts <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h1 class="fw-bold mb-0">203145</h1>
                                        <h6 class="text-muted">Commentaires</h6>
                                    </div>
                                    <div class="col-4">
                                        <h2 class="text-center fs-1">
                                            <i class="fas fa-comments"></i>
                                        </h2>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a href="" class="link-info">Liste des commentaires <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h1 class="fw-bold mb-0">15206</h1>
                                        <h6 class="text-muted">Articles</h6>
                                    </div>
                                    <div class="col-4">
                                        <h2 class="text-center fs-1">
                                            <i class="fas fa-clipboard-list"></i>
                                        </h2>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a href="" class="link-info">Liste des posts <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h1 class="fw-bold mb-0">50</h1>
                                        <h6 class="text-muted">Utilisateurs</h6>
                                    </div>
                                    <div class="col-4">
                                        <h2 class="text-center fs-1">
                                            <i class="fas fa-users"></i>
                                        </h2>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a href="user_list.php" class="link-info">Liste des utilisateurs <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

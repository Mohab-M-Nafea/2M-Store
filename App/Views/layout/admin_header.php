<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php url("assets/css/bootstrap.min.css") ?>">
    <link rel=" stylesheet" href="<?php url("assets/css/all.min.css") ?>">
    <link rel="stylesheet" href="<?php url("assets/css/main.css?t=" . time()) ?>">
    <link rel="stylesheet" href="<?php url("assets/css/admin.css?t=" . time()) ?>">
    <title id="page-title"><?php echo $pageName ?></title>
</head>

<body class="bg-light">
    <header>

        <?php if (isset($nav)) : ?>

            <nav class="navbar navbar-expand-lg bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?php url('dashboard') ?>">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <?php foreach ($nav as $nav_item) : ?>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php url('dashboard/' . $nav_item) ?>"><?php echo ucfirst($nav_item) ?></a>
                                </li>

                            <?php endforeach ?>

                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end bg-dark">
                                    <li><a class="dropdown-item" href="<?php url() ?>">Shop</a></li>
                                    <li><a class="dropdown-item" href="<?php url('admin/profile') ?>">Profile</a></li>
                                    <li><a class="dropdown-item disabled" href="#">Settings</a></li>
                                    <li><a class="dropdown-item" href="<?php url('user/logout') ?>">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php endif; ?>
        <!-- <nav class="nav navbar d-flex">
            <div class="nav-item p-2">
                logo
            </div>
            <div class="nav navbar-nav navbar-rigth p-2">
                test
            </div>
        </nav> -->
    </header>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php url("assets/css/bootstrap.min.css") ?>">
    <link rel=" stylesheet" href="<?php url("assets/css/all.min.css") ?>">
    <link rel="stylesheet" href="<?php url("assets/css/main.css?t=" . time()) ?>">
    <link rel="stylesheet" href="<?php url("assets/css/shop.css?t=" . time()) ?>">
    <!-- <link rel="stylesheet" href="<?php url("assets/css/rating.css?t=" . time()) ?>"> -->
    <title id="page-title"><?php echo $pageName ?></title>
</head>

<body class="bg-white">

    <?php if (isset($nav)) : ?>

        <header>
            <nav class="navbar navbar-expand-lg bg-white">
                <div class="container">
                    <a class="navbar-brand" href="<?php url() ?>">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav mb-2 mb-lg-0">
                            <?php if (isset($categories) && count($categories)) : ?>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Categories
                                    </a>
                                    <ul class="dropdown-menu bg-white">

                                        <?php foreach ($categories as $category) : ?>

                                            <li>
                                                <a class="dropdown-item" href="<?php url('Category/showCategory/' . $category["category_id"]) ?>"><?php echo ucfirst($category["category_name"]) ?></a>
                                            </li>

                                        <?php endforeach ?>

                                    </ul>
                                </li>

                            <?php endif ?>
                        </ul>
                        <ul class="nav navbar-nav ms-auto  mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a href="<?php url('customer/account') ?>" class="nav-link">
                                    <i class="fa-solid fa-user"></i> <span>My account</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php url('home/cart') ?>" class="nav-link">
                                    <i class="fa-solid fa-cart-shopping"></i> <span>Cart</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

    <?php endif; ?>
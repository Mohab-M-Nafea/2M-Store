<?php include 'layout/shop_header.php' ?>

<main class="container">
    <div class="my-4" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php url('Category/showCategory/' . $data["category_id"]) ?>"><?php echo $data["category_name"]?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $data["product_name"] ?></li>
        </ol>
    </div>
    <section class="d-flex flex-column flex-md-row flex-lg-row prdouct gap-3 my-5">
        <div class="col product-img">
            <img class="d-block w-100 img-fluid" src="<?php url($data["image"]) ?>" alt="...">
            <div class="favorites">
                <form method="post">
                    <button type="submit">
                        <span></span>
                    </button>
                </form>
            </div>
        </div>
        <div class="col product-info">
            <div class="row gap-2">
                <h3>
                    <?php echo $data["product_name"] ?>
                </h3>
                <p class="lead">
                    <?php echo $data["product_description"] ?>
                </p>
                <p class="lead">
                    Made in: <?php echo $data["made_in"] ?>
                </p>
                <div class="rating d-flex">
                    <div class="rating-star">
                        <span style="width: <?php echo $data["rate"] / 5 * 100 ?>%;"></span>
                    </div>
                    <div class="rating-number">
                        <p class="mb-0 mx-2">
                            <?php echo round($data["rate"], 1) ?>
                        </p>
                    </div>
                    <div class="voting-number">
                        <p class="mb-0 mx-2">
                            (Number votes: <?php echo $data["count_voting"] ?>)
                        </p>
                    </div>
                </div>
                <p class="lead">
                    <?php echo $data["price"] ?> EGP
                </p>
            </div>
            <div class="mt-3">
                <div class="container">
                    <form method="post">
                        <button type="submit" class="btn btn-outline-primary w-100 text-center fs-5" name="add_to_cart" <?php echo in_array($data['product_id'], $_SESSION['cart-list']) ? 'disabled' : '' ?>>
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span> <?php echo in_array($data['product_id'], $_SESSION['cart-list']) ? 'In Cart' : 'Add to Cart' ?></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="d-flex justify-content-center">
        <div class="rating-box">
            <p>Rate this product</p>
            <div class="stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
        </div>
    </section> -->
    <section class="row comments gap-3 justify-content-center mb-3">
        <div class="comments-count d-flex justify-content-end">
            <p class="lead">
                <?php echo count($data["comments"]) ?> comments
            </p>
        </div>
        <form class="mb-5" method="post">
            <textarea name="comment" class="form-control mb-3"></textarea>
            <input type="submit" class="btn btn-primary" name="make-comment" value="Comment">
        </form>

        <?php foreach ($data["comments"] as $comment) : ?>

            <div class="display-comments form-control">
                <div class="user-info d-flex gap-3 my-2">
                    <img class="img-fluid" src="<?php url($comment['gender'] ? 'Uploads/Avatar/woman_avatar.jpg' : 'Uploads/Avatar/men_avatar.jpg') ?>" alt="...">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="username">
                                <?php echo $comment["username"] ?>
                            </p>
                            <p class="comment-date lead">
                                <?php echo $comment["comment_date"] ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <p class="lead">
                        <?php echo $comment["comment"] ?>
                    </p>
                </div>
            </div>

        <?php endforeach ?>

    </section>
</main>

<?php include 'layout/shop_footer.php' ?>
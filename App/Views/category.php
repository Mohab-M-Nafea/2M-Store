<?php include 'layout/shop_header.php' ?>

<main class="container-fluid row">
    <div class="container mx-5">
        <div class="my-4" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageName ?></li>
            </ol>
        </div>
    </div>
    <h1>
        <?php echo $pageName ?>
    </h1>
    <aside class="col-3">
        <div>
            hi
        </div>
    </aside>
    <section class="col">
        <div class="gategory-product row">

            <?php foreach ($data as $product) : ?>

                <div class="col-sm-4 mb-4">
                    <div class="card">
                        <a href="<?php url('product/showProduct/' . $product["product_id"]) ?>">
                            <div class="product-image">
                                <img src="<?php url($product["image"]) ?>" class="card-img-top img-thumbnail" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product["product_name"] ?></h5>
                                <p class="card-text"><?php echo $product["product_description"] ?></p>
                            </div>
                            <div class="card-footer">
                                <p class="card-text"><?php echo $product["price"] ?> EGP</p>
                            </div>
                            <div class="favorites">
                                <form method="post">
                                    <button type="submit">
                                        <span>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </a>
                    </div>
                </div>

            <?php endforeach ?>

        </div>
    </section>
</main>

<?php include 'layout/shop_footer.php' ?>
<?php include 'layout/shop_header.php' ?>

<main class="container">
    <section class="hot-offers my-5">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">

                <?php for ($button = 0; $button < count($images); $button++) : ?>

                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?php echo $button ?>" <?php echo !$button ? "class='active' aria-current='true'" : "" ?> aria-label='Slide <?php echo $button + 1 ?>'></button>

                <?php endfor ?>

            </div>
            <div class="carousel-inner">

                <?php $first = true ?>
                <?php foreach ($images as $image) : ?>

                    <div class="carousel-item <?php echo $first ? 'active' : '' ?>">
                        <img src="<?php url('Uploads/Carousel/' . $image) ?>" class="d-block w-100 img-fluid" alt="...">
                    </div>

                    <?php $first = false ?>
                <?php endforeach ?>
            </div>
            <button class="carousel-control-prev rounded-circle" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next rounded-circle" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <?php foreach ($categories as $category) :
        $products = new Product;
        $products = $products->getTopProducts($category['category_id'])->fetchAll();
        if (!empty($products)) :
            $count = 0
    ?>

            <section class="top-rated">
                <div class="header">
                    <?php echo strtoupper($category["category_name"]) ?>
                </div>
                <div id="<?php echo str_replace(' ', '-', str_replace('&', '', $category["category_name"])) ?>-top-rated" class="carousel slide" data-bs-ride="false" data-bs-wrap="false">
                    <div class="carousel-inner" role="listbox">
                        <?php foreach ($products as $product) : ?>

                            <div class="carousel-item <?php echo !$count ? 'active' : '' ?>">
                                <div class="col-sm-3 mb-4">
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
                            </div>

                        <?php
                            $count++;
                        endforeach ?>

                    </div>

                    <button class="carousel-control-prev rounded-circle" type="button" data-bs-target="#<?php echo str_replace(' ', '-', str_replace('&', '', $category["category_name"])) ?>-top-rated" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next rounded-circle" type="button" data-bs-target="#<?php echo str_replace(' ', '-', str_replace('&', '', $category["category_name"])) ?>-top-rated" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </section>

        <?php endif ?>
    <?php endforeach ?>

</main>

<?php include 'layout/shop_footer.php' ?>

<script src="<?php url("assets/js/top-rated.js?t=" . time()) ?>"></script>
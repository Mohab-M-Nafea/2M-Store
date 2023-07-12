<?php include 'layout/admin_header.php' ?>

<main class="container mt-5">

    <?php if (isset($err)) : ?>

        <div class="modal fade" id="error-dialog" tabindex="-1" aria-labelledby="error-dialog-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="error-dialog-label">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>
                                Modal title
                            </span>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger">

                        <?php foreach ($err as $e) : ?>

                            <div class="mb-1">

                                <?php echo $e ?>

                            </div>

                        <?php endforeach ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <?php endif ?>

    <div class="row">
        <div class="header">
            ADD NEW PRODUCT
        </div>
        <div class="form">
            <form class="needs-" method="post" novalidate enctype="multipart/form-data">
                <div class="row">
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="product_name">product name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required="required">
                        <div class="invalid-feedback">
                            product name is require
                        </div>
                    </div>
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="product_description">Description</label>
                        <input type="text" name="product_description" id="product_description" class="form-control">
                    </div>
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" required min="0">
                        <div class="invalid-feedback">
                            Price is require
                        </div>
                    </div>
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required value="1" min="0">
                        <div class="invalid-feedback">
                            Quantity is require
                        </div>
                    </div>
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="country">Made in</label>
                        <div class="dropdown">
                            <button class="dropdown-toggle btn form-control" id="country" data-bs-toggle="dropdown" aria-expanded="false">
                                Country
                                <i class="fa-solid fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu col-12">
                                <li class="dropdown-item" id="China">China</li>
                                <li class="dropdown-item" id="Egypt">Egypt</li>
                                <li class="dropdown-item" id="UAE">UAE</li>
                                <li class="dropdown-item" id="USA">USA</li>
                            </ul>
                            <input type="hidden" name="country">
                        </div>
                    </div>
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="category">Category</label>
                        <div class="dropdown">
                            <button class="dropdown-toggle btn form-control" id="category" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                                <i class="fa-solid fa-caret-down"></i>
                            </button>

                            <?php if (!empty($categories)) : ?>

                                <ul class="dropdown-menu col-12">
                                    <?php foreach ($categories as $category) : ?>

                                        <li class="dropdown-item" id="<?php echo $category["category_id"] ?>"><?php echo $category["category_name"] ?></li>

                                    <?php endforeach ?>
                                </ul>

                                <input type="hidden" name="category">

                            <?php endif ?>
                        </div>
                    </div>
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="category">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-dark" name="add_product">
                            ADD NEW PRODUCT
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include 'layout/admin_footer.php' ?>
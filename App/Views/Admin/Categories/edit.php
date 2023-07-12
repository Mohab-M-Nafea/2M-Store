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
            EDIT <?php echo strtoupper($category["category_name"]) ?> CATEGORY
        </div>
        <div class="form">
            <form class="needs-validation" method="post" novalidate>
                <div class="row">
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="firstname">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" required="required" value="<?php echo $category["category_name"] ?>">
                        <div class="invalid-feedback">
                            Category NAME is require
                        </div>
                    </div>
                    <div class="upper-label col-sm-6 mb-3">
                        <label for="firstname">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="<?php echo $category["description"] ?>">
                        <div class="invalid-feedback">
                            Description is require
                        </div>
                    </div>
                    <div class="upper-label col-sm-6  mb-3">
                        <label for="username">Order</label>
                        <input type="number" name="ordering" id="ordering" class="form-control" required value="<?php echo $category["ordering"] ?>">
                        <div class="invalid-feedback">
                            Order is require
                        </div>
                    </div>
                    <div class="row col-sm-12 mb-3">
                        <label for="visibility" class="col-lg-2 col col-form-label">Visibility:</label>
                        <div class="form-check form-switch col fs-3">
                            <input type="checkbox" name="visibility" id="visibility" class="form-check-input" <?php echo $category["visibility"] ? "checked" : "" ?>>
                        </div>
                    </div>
                    <div class="row col-sm-12 mb-3">
                        <label for="allow_ads" class="col-lg-2 col col-form-label">Allow Ads:</label>
                        <div class="form-check form-switch col fs-3">
                            <input type="checkbox" name="allow_ads" id="allow_ads" class="form-check-input" <?php echo $category["allow_ads"] ? "checked" : "" ?>>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success" name="edit_category">
                        EDIT CATEGORY
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include 'layout/admin_footer.php' ?>
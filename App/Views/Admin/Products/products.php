<?php include 'layout/admin_header.php' ?>

<main class="container">
    <h1><?php echo $pageName ?></h1>
    <div class="table-responsive mb-4">
        <div class="products-table">
            <table class="table table-white table-hover table-bordered align-middle text-center">
                <thead class="table-dark align-items-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Made in</th>
                        <th scope="col">Added Date</th>
                        <th scope="col">Category</th>
                        <th scope="col">Username</th>
                        <th scope="col">Control</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($products)) : ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <th scope="row"><?php echo $product["product_id"] ?></th>
                                <td class="text-truncate"><?php echo $product["product_name"] ?></td>
                                <td class="text-truncate"><?php echo $product["product_description"] ?></td>
                                <td class="text-truncate"><?php echo $product["price"] ?> EGP</td>
                                <td class="text-truncate"><?php echo $product["quantity"] ?></td>
                                <td class="text-truncate"><?php echo $product["made_in"] ?></td>
                                <td class="text-truncate"><?php echo $product["added_date"] ?></td>
                                <td class="text-truncate"><?php echo $product["category_name"] ?></td>
                                <td class="text-truncate"><?php echo $product["username"] ?></td>
                                <td class="controls">
                                    <a href="<?php url("dashboard/products/editProduct/" . $product["product_id"]) ?>" class="btn btn-success" role="button"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <a class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $product["product_id"] ?>"><i class="fa-solid fa-trash-can"></i> Delete</a>
                                    <div class="modal fade" id="delete-<?php echo $product["product_id"] ?>" tabindex="-1" aria-labelledby="<?php echo $product["product_name"] ?>ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="<?php echo $product["product_name"] ?>ModalLabel">Delete <?php echo $product["product_name"] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Are you sure you want to delete this product: <?php echo $product["product_name"] ?>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="<?php url("dashboard/products/deleteProduct/" . $product["product_id"]) ?>" class="btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="<?php url('dashboard/products/addProduct') ?>" class="btn btn-primary" role="button"><i class="fa-solid fa-plus"></i> Add Product</a>
</main>

<?php include 'layout/admin_footer.php' ?>
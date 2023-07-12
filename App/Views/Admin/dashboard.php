<?php include 'layout/admin_header.php' ?>

<main class="container">
    <div class="info row gap-3 my-5">
        <a href="<?php url("dashboard/members") ?>" class="col">
            <div class="members-info d-flex align-items-center justify-content-evenly">
                <div class="text-center my-3">
                    <?php echo $data["total_members"] ?>
                    <div class="text">
                        Total Members
                    </div>
                </div>
                <i class="fa-solid fa-users"></i>
            </div>
        </a>
        <a href="<?php url("dashboard/categories") ?>" class="col">
            <div class="categories-info d-flex col align-items-center justify-content-evenly">
                <div class="text-center my-3">
                    <?php echo $data["total_categories"] ?>
                    <div class="text">
                        Total Categories
                    </div>
                </div>
                <i class="fa-solid fa-cubes-stacked"></i>
            </div>
        </a>
        <a href="<?php url("dashboard/products") ?>" class="col">
            <div class="products-info d-flex col align-items-center justify-content-evenly">
                <div class="text-center my-3">
                    <?php echo $data["total_products"] ?>
                    <div class="text">
                        Total Products
                    </div>
                </div>
                <i class="fa-solid fa-tags"></i>
            </div>
        </a>
        <a href="<?php url("dashboard/comments") ?>" class="col">
            <div class="comments-info d-flex col align-items-center justify-content-evenly">
                <div class="text-center my-3">
                    <?php echo $data["total_comments"] ?>
                    <div class="text">
                        Total Comments
                    </div>
                </div>
                <i class="fa-solid fa-comments"></i>
            </div>
        </a>
    </div>
    <div class="last d-flex flex-column flex-lg-row gap-3">
        <div class="accordion col" id="members">
            <div class="accordion-item">
                <div class="accordion-header" id="member">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#last-members" aria-expanded="false" aria-controls="last-members">
                        Last 5 Members Regesitered
                    </button>
                </div>
                <div id="last-members" class="last-members accordion-collapse collapse show" aria-labelledby="last-members" data-bs-parent="#members">
                    <div class="accordion-body">
                        <table class="table table-striped table-hover">
                            <tbody>

                                <?php foreach ($last_members as $member) : ?>

                                    <tr>
                                        <td>
                                            <a href="<?php url("dashboard/members/editMember/" . $member["user_id"]) ?>">

                                                <?php echo $member["username"] ?>

                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion col mb-3" id="products">
            <div class="accordion-item">
                <div class="accordion-header" id="member">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#last-products" aria-expanded="false" aria-controls="last-products">
                        Last 5 Products Added
                    </button>
                </div>
                <div id="last-products" class="last-products accordion-collapse collapse show" aria-labelledby="last-products" data-bs-parent="#products">
                    <div class="accordion-body">
                        <table class="table table-striped table-hover">
                            <tbody>

                                <?php foreach ($last_products as $product) : ?>

                                    <tr>
                                        <td>
                                            <a href="<?php url("dashboard/products/editProduct/" . $product["product_id"]) ?>">

                                                <?php echo $product["product_name"] ?>

                                            </a>
                                        </td>
                                    </tr>

                                <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'layout/admin_footer.php' ?>
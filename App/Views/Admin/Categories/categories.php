<?php include 'layout/admin_header.php' ?>

<main class="container">
    <h1><?php echo $pageName ?></h1>
    <div class="accordion mb-4" id="categories">

        <?php if (isset($categories)) :
            foreach ($categories as $category) :
                $cat_name = str_replace(' ', '-', str_replace('&', '', $category["category_name"])); ?>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="<?php echo $cat_name ?>-panel">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $cat_name ?>" aria-expanded="false" aria-controls="<?php echo $cat_name ?>">
                            <?php echo $category["category_name"] ?>
                        </button>
                    </h2>
                    <div id="<?php echo $cat_name ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo $cat_name ?>" data-bs-parent="#categories">
                        <div class="accordion-body">
                            <h6 class="mb-2 text-muted">

                                <?php echo $category["description"] === '' ? "This category has no description" : $category["description"]; ?>

                            </h6>
                            <div class="state d-flex align-items-center">

                                <?php
                                if ($category["visibility"] === 0) {
                                    echo '<div class="visibility me-3">';
                                    echo  "Hidden";
                                    echo '</div>';
                                }

                                if ($category["allow_ads"] === 0) {
                                    echo '<div class="ads me-3">';
                                    echo  "Disabled Ads";
                                    echo '</div>';
                                }
                                ?>

                                <div class="buttons ms-auto">
                                    <a href="<?php url("dashboard/categories/editCategory/" . $category["category_id"]) ?>" class="btn btn-success">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $category["category_id"] ?>">
                                        <i class="fa-solid fa-trash-can"></i>
                                        Delete
                                    </a>
                                    <div class="modal fade" id="delete-<?php echo $category["category_id"] ?>" tabindex="-1" aria-labelledby="<?php echo $cat_name ?>ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="<?php echo $cat_name ?>ModalLabel">Delete <?php echo $category["category_name"] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Are you sure you want to delete the <?php echo $category["category_name"] ?> category?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="<?php url("dashboard/categories/deleteCategory/" . $category["category_id"]) ?>" class="btn btn-primary">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach ?>
        <?php endif ?>

    </div>
    <a href="<?php url('dashboard/categories/addCategory') ?>" class="btn btn-primary" role="button"><i class="fa-solid fa-plus"></i> Add Category</a>
</main>

<?php include 'layout/admin_footer.php' ?>
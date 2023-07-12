<?php include 'layout/admin_header.php' ?>

<main class="container">
    <h1><?php echo $pageName ?></h1>
    <div class="table-responsive mb-4">
        <div class="comments-table">
            <table class="table table-white table-hover table-bordered align-middle text-center">
                <thead class="table-dark align-items-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Comment Date</th>
                        <th scope="col">Username</th>
                        <th scope="col">Product</th>
                        <th scope="col">Control</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($comments)) : ?>
                        <?php foreach ($comments as $comment) : ?>
                            <tr>
                                <th scope="row"><?php echo $comment["comment_id"] ?></th>
                                <td><?php echo $comment["comment"] ?></td>
                                <td><?php echo $comment["comment_date"] ?></td>
                                <td><?php echo $comment["username"] ?></td>
                                <td><?php echo $comment["product_name"] ?></td>
                                <td>
                                    <a href="<?php url("dashboard/comments/editComment/" . $comment["comment_id"]) ?>" class="btn btn-success" role="button"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <a class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#delete-<?php echo $comment["comment_id"] ?>"><i class="fa-solid fa-trash-can"></i> Delete</a>
                                    <div class="modal fade" id="delete-<?php echo $comment["comment_id"] ?>" tabindex="-1" aria-labelledby="<?php echo $comment["comment"] ?>ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="<?php echo $comment["comment"] ?>ModalLabel">Delete <?php echo $comment["comment"] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Are you sure you want to delete this comment: <?php echo $comment["comment"] ?>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="<?php url("dashboard/comments/deleteComment/" . $comment["comment_id"]) ?>" class="btn btn-primary">Delete</a>
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
</main>

<?php include 'layout/admin_footer.php' ?>